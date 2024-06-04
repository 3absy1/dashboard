<?php

namespace Modules\ReferenceModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\ReferenceModule\App\Models\Reference;
use Modules\ReferenceModule\App\Models\ExcelData;
use Modules\ReferenceModule\App\Imports\Import;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ReferenceModule\App\Imports\Code;
use Modules\ReferenceModule\App\Imports\Name;
use Modules\ReferenceModule\App\Exports\Export;



class CheckController extends Controller
{
    public function index()
    {
        return view('referencemodule::Check.check',[
            'exceldata' => ExcelData::all(),
            'references' => Reference::all()
        ]);
    }
    public function search()
    {
        return view('referencemodule::Check.checkSearch',[
            'exceldata' => ExcelData::all(),
            'references' => Reference::all()
        ]);
    }
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

    if ($request->file('file')->isValid()) {
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
            $headers = array_filter($stringHeaders, function($header) {
                return !is_numeric($header);
            });

            return view('referencemodule::Check.checkColums',compact('headers'));
        }

        return redirect()->back()->with('error', 'Please select a file to upload.');
    }

    return "Error: Invalid file.";
}

public function upload(Request $request)
{

    $filePath = session('excelFilePath');
    $name =$request->name;
    $code =$request->code;
    ExcelData::query()->delete();
    if($request->select == 1)
    {

        (new Name($name,$code ))->import($filePath);

    }
    elseif($request->select == 2)
    {
        (new Code($name,$code))->import($filePath);

    }

    return redirect()->route('search') ;
}
public function export(Request $request)
{

    $data = ExcelData::select('name', 'code')->get();
    return Excel::download(new Export($data), 'references.xlsx');

}

}
