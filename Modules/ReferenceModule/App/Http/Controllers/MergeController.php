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

use Modules\ReferenceModule\App\Models\Merge;

class MergeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('referencemodule::merge');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls', // Allow only Excel files
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
            $headers = array_filter($stringHeaders, function($header) {
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

            return view('referencemodule::mergeColums',compact('tableName','headers'));
        }

        return redirect()->back()->with('error', 'Please select a file to upload.');
    }

    return "Error: Invalid file.";
}



public function uploadMerge(Request $request)
{
    $tableName = $request->input('tableName');
    $entry = $request->input('entry');
    $total = $request->total;

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

    Session::put('entry', $entry);
    Session::put('total', $total);
    $cacheKey = 'merged_data_' . uniqid();
    Cache::put($cacheKey, $mergedData, now()->addMinutes(30)); // Cache for 30 minutes

    // Store cache key in the session
    Session::put('merged_data_cache_key', $cacheKey);
    $totalRows = Session::get('totalRows');

return view('referencemodule::mergeSearch',[
    'merges' =>  $mergedData,
    'entrys'=>  $entry,
    'total'=>  $total,
    'totalRows' => $totalRows,


]);
}

public function export()
{
    $entry = Session::get('entry');
    $total = Session::get('total');
    $cacheKey = Session::get('merged_data_cache_key');

    $mergedData = Cache::get($cacheKey);

    return Excel::download(new MergeExport($mergedData,$entry,$total), 'mergeData.xlsx');

}


}
