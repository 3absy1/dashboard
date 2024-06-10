<?php

namespace Modules\ReferenceModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ReferenceModule\App\Imports\RelatedImport;
use Modules\ReferenceModule\App\Models\Related;
use Modules\ReferenceModule\App\Models\Reference;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ReferenceModule\App\Imports\Import;
use Illuminate\Support\Facades\Validator;
use Modules\ReferenceModule\App\DataTables\RelatedDataTable;
use Modules\ReferenceModule\App\Models\CheckData;

class RelatedController extends Controller
{
    public function index(RelatedDataTable $dataTable)
    {
        $relateds=Related::all();
        $references=Reference::all();
        return $dataTable->render('referencemodule::Related.related',compact('relateds','references'));

    }

    public function checkcreate(Request $request)
    {
        $relatedData = $request->input('data', []);

        $validator = Validator::make($relatedData, [
            '*.reference_id' => 'required|not_in:null',
            '*.name' => 'required|string',
            '*.code' => 'required|string|unique:references,code',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        CheckData::query()->delete();

        foreach ($relatedData as $data) {
            Related::create([
                'reference_id' => $data['reference_id'],
                'name' => $data['name'],
                'code' => $data['code'],
                'flag' => 1,
            ]);
        }
        return redirect()->route('related.index');
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'reference_id' => 'required|exists:references,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:references,code',
        ]);

        Related::create([
            'reference_id' => $validatedData['reference_id'],
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'flag' => 1,
        ]);

        return redirect()->route('related.index')->with('success', 'Related record created successfully');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:references,code',
        ]);
        try {

            $related = Related::find($request->id);

            $related->name = $validatedData['name'];
            $related->code = $validatedData['code'];
            $related->reference_id = $request->reference_id;
            if (!empty($related->reference_id)) {
                $related->flag = 1;
            }
            $related->save();

            return redirect()->route('related.index')->with('success', 'Related record updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $reference = Related::find($id);
        return response()->json($reference);
    }

    public function referenceinsert(Request $request)
    {
        try {
            $related = Related::find($request->id);
            $related->reference_id = $request->reference_id;

            if (!empty($related->reference_id)) {
                $related->flag = 1;
            }
            $related->save();
            return redirect()->route('related.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        Related::destroy($id);
        return redirect()->route('related.index');
    }

    public function relatedUpload(Request $request)
    {
        $filePath = session('excelFilePath');
        $name = $request->name;
        $code = $request->code;
        $reference_code = $request->reference_code;
        $import = new RelatedImport($name, $code, $reference_code);
        $import->import($filePath);

        return redirect()->route('related.index');
    }


    public function importFile(Request $request)
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
                $headers = array_filter($stringHeaders, function ($header) {
                    return !is_numeric($header);
                });
                return view('referencemodule::Related.relatedImport', compact('headers'));
            }
            return redirect()->back()->with('error', 'Please select a file to upload.');
        }
        return "Error: Invalid file.";
    }
}
