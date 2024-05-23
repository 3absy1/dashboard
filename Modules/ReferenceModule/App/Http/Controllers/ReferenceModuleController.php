<?php

namespace Modules\ReferenceModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\ReferenceModule\App\Exports\Export;
use Modules\ReferenceModule\App\Imports\Import;
use Modules\ReferenceModule\App\Imports\Name;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ReferenceModule\App\Models\Reference;
use Modules\ReferenceModule\App\Models\Related;
use Modules\ReferenceModule\App\Models\ExcelData;
use Modules\ReferenceModule\App\Imports\Code;
use Modules\ReferenceModule\App\Imports\ReferenceImport;
use Modules\ReferenceModule\App\Models\WasteReference;

class ReferenceModuleController extends Controller
{


    public function home()
    {
        return view('referencemodule::home',[
        ]);
    }


    public function index()
    {
        return view('referencemodule::dashboard',[
            'exceldata' => ExcelData::all(),
            'references' => Reference::all()

            // 'relateds' => Related::all()
        ]);
    }
    public function show()
    {
        return view('referencemodule::users-access',[
            'references' => Reference::all(),
            'wastereferences' => WasteReference::all(),

        ]);
    }
    public function colums()
    {
        return view('referencemodule::colums',[
            // 'relateds' => Related::all()
        ]);
    }

    public function create(Request $request)
    {
        Reference::create([
            'name'=>$request->name,
            'code'=>$request->code,

        ]);
        return redirect()->route('reference');

    }




    public function update(Request $request)
    {
        try {
            $reference = Reference::find($request->id);
            $reference->name=$request->name;
            $reference->code=$request->code;

            $reference->save();

            return redirect()->route('reference');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        }


        public function delete($id)
        {
            Reference::destroy($id);
                return redirect()->route('reference');

        }

        public function uploadReference(Request $request)
        {
            $filePath = session('excelFilePath');
            $name =$request->name;
            $code =$request->code;

            // ExcelData::query()->delete();
            (new ReferenceImport($name,$code))->import($filePath);


            return redirect()->route('reference') ;
    }


    public function referenceUploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls', // Allow only Excel files
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

            // Re-index the array to avoid gaps in the index
            $headers = array_values($headers);
            return view('referencemodule::referenceImport',compact('headers'));
        }

        return redirect()->back()->with('error', 'Please select a file to upload.');
    }

    return "Error: Invalid file.";
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
                session(['excelFilePath' => $filePath]);

                $import = new Import();
                $importedData = Excel::toCollection($import, $filePath);
                $firstRow = $importedData->first()->first();
                $headers = $firstRow->keys()->toArray();
                // $headers = Excel::toArray(new Import(), $filePath);

                return view('referencemodule::colums',compact('headers'));
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

        return redirect()->route('dashboard') ;
    }



    public function export(Request $request)
    {

        $data = ExcelData::select('name', 'code')->get();
        return Excel::download(new Export($data), 'references.xlsx');

    }





}
