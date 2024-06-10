<?php

namespace Modules\ReferenceModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ReferenceModule\App\Models\Reference;
use Modules\ReferenceModule\App\Models\CheckData;
use Modules\ReferenceModule\App\Imports\Import;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ReferenceModule\App\DataTables\CheckDataTable;
use Modules\ReferenceModule\App\Imports\Code;
use Modules\ReferenceModule\App\Imports\Name;
use Modules\ReferenceModule\App\Exports\CheckExport;
use Illuminate\Support\Facades\DB;


class CheckController extends Controller
{
    public function index()
    {
        return view('referencemodule::Check.check', [
            'CheckData' => CheckData::all(),
            'references' => Reference::all()
        ]);
    }

    public function search(CheckDataTable $dataTable)
    {
        $CheckData = CheckData::all();
        return $dataTable->render('referencemodule::Check.checkSearch', compact('CheckData'));
    }
    public function matchColumns(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('public', $fileName);
            session(['excelFilePath' => $filePath]);

            $import = new Import();
            $importedData = Excel::toCollection($import, $filePath);
            $firstRow = $importedData->first()->first();
            $stringHeaders = $firstRow->keys()->toArray();
            // $headers = Excel::toArray(new Import(), $filePath);
            $headers = array_filter($stringHeaders, function ($header) {
                return !is_numeric($header);
            });

            return view('referencemodule::Check.checkImport', compact('headers'));
        }
    }

    public function import(Request $request)
    {

        $filePath = session('excelFilePath');
        $name = $request->name;
        $code = $request->code;
        CheckData::query()->delete();
        DB::statement('ALTER TABLE check_data AUTO_INCREMENT = 1;');

        if ($request->select == 1) {

            (new Name($name, $code))->import($filePath);
        } elseif ($request->select == 2) {
            (new Code($name, $code))->import($filePath);
        }

        return redirect()->route('check.search');
    }


    public function export()
    {

        $data = CheckData::select('name', 'code')->get();
        return Excel::download(new CheckExport($data), 'references.xlsx');
    }
}
