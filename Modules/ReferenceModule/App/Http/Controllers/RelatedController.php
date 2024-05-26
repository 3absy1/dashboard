<?php

namespace Modules\ReferenceModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ReferenceModule\App\Imports\RelatedImport;
use Modules\ReferenceModule\App\Models\Related;
use Modules\ReferenceModule\App\Models\Reference;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ReferenceModule\App\Imports\Import;
use Modules\ReferenceModule\App\Models\ExcelData;
use Illuminate\Support\Facades\Validator;





class RelatedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('referencemodule::users-roles',[
            'relateds' => Related::all(),
            'references' => Reference::all()

        ]);
    }

    public function create(Request $request)
    {
        $relatedData = $request->input('data', []);

        $validator = Validator::make($relatedData, [
            '*.reference_id' => 'required|not_in:null',
            '*.name' => 'required|string',
            '*.code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        ExcelData::query()->delete();

        dd($relatedData['reference_id']);
        foreach ($relatedData as $data) {
            Related::create([
                'reference_id' => $data['reference_id'],
                'name' => $data['name'],
                'code' => $data['code'],
            ]);
        }


        return redirect()->route('related');
    }

    public function new(Request $request)
    {
            Related::create([
                'reference_id' => $request['reference_id'],
                'name' => $request['name'],
                'code' => $request['code'],
            ]);


        return redirect()->route('related');
    }



        public function update(Request $request)
        {
            // dd($request->code);

            try {
                $related = Related::find($request->id);
                $related->name=$request->name;
                $related->code=$request->code;
                $related->reference_id=$request->reference_id;

                $related->save();

                return redirect()->route('related');
            }
            catch
            (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
            }

            public function referenceinsert(Request $request)
            {
                // dd($request->code);

                try {
                    $related = Related::find($request->id);

                    $related->reference_id=$request->reference_id;

                    $related->save();

                    return redirect()->route('related');
                }
                catch
                (\Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
                }


            public function delete($id)
            {
                Related::destroy($id);
                    return redirect()->route('related');

            }

            public function uploadRelated(Request $request)
            {
                $filePath = session('excelFilePath');
                $name =$request->name;
                $code =$request->code;
                // ExcelData::query()->delete();
                (new RelatedImport($name,$code))->import($filePath);


                return redirect()->route('related') ;
        }


        public function relatedUploadFile(Request $request)
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
                });                // $headers = Excel::toArray(new Import(), $filePath);

                return view('referencemodule::relatedImport',compact('headers'));
            }

            return redirect()->back()->with('error', 'Please select a file to upload.');
        }

        return "Error: Invalid file.";
    }

}
