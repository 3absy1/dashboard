<?php

namespace Modules\ReferenceModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Modules\ReferenceModule\App\Exports\MergeExport;
use Modules\ReferenceModule\App\Imports\Import;
use Modules\ReferenceModule\App\Imports\MergeImport;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Session;
use Modules\ReferenceModule\App\DataTables\MergeDataTable;
use Modules\ReferenceModule\App\Models\Merge;

class MergeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('referencemodule::Merge.merge');
    }

    public function importfile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($request->file('file')->isValid()) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('public', $fileName);
                $tableName = 'file_table';
                session(['excelFilePath' => $filePath]);

                if (Schema::hasTable($tableName)) {
                    Schema::dropIfExists($tableName);
                }
                $import = new Import();
                $importedData = Excel::toCollection($import, $filePath);
                $firstRow = $importedData->first()->first();
                $stringHeaders = $firstRow->keys()->toArray();
                // $headers = Excel::toArray(new Import(), $filePath);
                $data = $importedData->collapse()->toArray(); // Convert data to array
                $headers = array_filter($stringHeaders, function ($header) {
                    return !is_numeric($header);
                });
                $tableName = 'file_table';
                Schema::create($tableName, function ($table) use ($headers) {
                    foreach ($headers as $header) {
                        if (!is_numeric($header)) {
                            $table->string($header)->nullable();
                        }
                    }
                    $table->timestamps();
                });
                foreach ($data as $row) {
                    $filteredRow = collect($row)->reject(function ($value, $key) {
                        return is_numeric($key);
                    })->toArray();

                    DB::table($tableName)->insert($filteredRow);
                }
                $totalRows = DB::table($tableName)->where(function ($query) use ($headers) {
                    foreach ($headers as $header) {
                        $query->whereNotNull($header);
                    }
                })->count();
                Session::put('totalRows', $totalRows);

                return view('referencemodule::Merge.mergeImport', compact('headers'));
            }

            return redirect()->back()->with('error', 'Please select a file to upload.');
        }

        return "Error: Invalid file.";
    }



    public function mergeUpload(Request $request)
    {
        $tableName = 'file_table';
        $entry = $request->input('entry');
        $total = $request->total;
        $merge_table = 'merge';

        if (Schema::hasTable($merge_table)) {
            Schema::dropIfExists($merge_table);
        }

        $entriesQuery = DB::table($tableName);

        foreach ($entry as $header) {
            $entriesQuery->selectRaw($header);
        }

        foreach ($total as $header) {
            $entriesQuery->selectRaw("SUM(`$header`) as `$header`");
        }

        foreach ($entry as $header) {
            $entriesQuery->groupBy($header);
            $entriesQuery->selectRaw("COUNT(*) as count");
        }
        $mergedData = $entriesQuery->get();


        Schema::create($merge_table, function ($table) use ($entry, $total) {
            $table->id();
            foreach ($entry as $header) {
                $table->string($header)->nullable();
            }
            foreach ($total as $header) {
                $table->integer($header);
            }
            $table->integer('count')->nullable();
            $table->timestamps();
        });
        foreach ($mergedData as $data) {
            $dataArray = (array) $data;
            if (in_array(null, $dataArray, true)) {
                continue;
            }
            DB::table('merge')->insert($dataArray);
        }

        Session::put('entry', $entry);
        Session::put('total', $total);
        $cacheKey = 'merged_data_' . uniqid();
        Cache::put($cacheKey, $mergedData, now()->addMinutes(30));
        Session::put('merged_data_cache_key', $cacheKey);
        $totalRows = Session::get('totalRows');


        return redirect()->route('merge.file');
    }
    public function merge(MergeDataTable $dataTable)
    {
        $totalRows = Session::get('totalRows');
        return $dataTable->render('referencemodule::Merge.mergedTable', compact('totalRows'));
    }

    public function export()
    {
        $entry = Session::get('entry');
        $total = Session::get('total');
        $cacheKey = Session::get('merged_data_cache_key');

        $mergedData = Cache::get($cacheKey);

        return Excel::download(new MergeExport($mergedData, $entry, $total), 'mergeData.xlsx');
    }
}
