<?php

namespace Modules\ReferenceModule\App\Http\Controllers;

use Modules\ReferenceModule\App\DataTables\UnValidReferenceDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ReferenceModule\App\Imports\Import;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ReferenceModule\App\DataTables\ReferencesDataTable;
use Modules\ReferenceModule\App\Exports\UnValidReferenceExport;
use Modules\ReferenceModule\App\Models\Reference;
use Modules\ReferenceModule\App\Models\Related;
use Modules\ReferenceModule\App\Imports\ReferenceImport;
use Modules\ReferenceModule\App\Models\ValidReference;
use Modules\ReferenceModule\App\Models\UnValidReference;
use Illuminate\Support\Facades\DB;


class ReferenceController extends Controller
{

    public function index(ReferencesDataTable $dataTable)
    {
        $references = Reference::all();
        return $dataTable->render('referencemodule::Reference.reference', compact('references'));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:related,code',
        ]);

        Reference::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
        ]);
        return redirect()->route('reference.index');
    }

    public function edit($id)
    {
        $reference = Reference::find($id);
        return response()->json($reference);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:related,code',
        ]);
        try {

            $reference = Reference::find($id);
            // dd($validatedData['code']);

            $reference->name = $validatedData['name'];
            $reference->code = $validatedData['code'];

            $reference->save();

            return redirect()->route('reference.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        Reference::destroy($id);
        return redirect()->route('reference.index');
    }

    public function uploadReference(Request $request)
    {
        $filePath = session('excelFilePath');
        $name = $request->name;
        $code = $request->code;

        (new ReferenceImport($name, $code))->import($filePath);

        // if (ValidReference::where('flag', 1)) {
        // $create = ValidReference::where('flag', 1)->get();
        // foreach ($create as $data) {
        //     UnValidReference::create([
        //         'name' => $data->name,
        //         'code' => $data->code,
        //         'reason' => 'code is repaided.',
        //     ]);
        //     $data->delete();
        // }
        //}

        return redirect()->route('reference.valid-Waste');
    }


    public function importFile(Request $request)
    {
        ValidReference::query()->delete();
        UnValidReference::query()->delete();
        DB::statement('ALTER TABLE un_valid_references AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE valid_references AUTO_INCREMENT = 1;');

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

                $headers = array_values($headers);
                return view('referencemodule::Reference.referenceImport', compact('headers'));
            }

            return redirect()->back()->with('error', 'Please select a file to upload.');
        }

        return "Error: Invalid file.";
    }


    public function validAndWaste()
    {

        return view('referencemodule::Reference.validandwaste', [
            'valid' => DB::table('valid_references')->paginate(100),
            'waste' => DB::table('un_valid_references')->paginate(100),
            // 'valid' => ValidReference::all(),
            // 'waste' => UnValidReference::all(),
        ]);
    }

    public function RreferenceApprove(Request $request)
    {
        $all = ValidReference::all();
        foreach ($all as $validReference) {

            Reference::create([
                'name' => $validReference['name'],
                'code' => $validReference['code'],
            ]);
        }

        ValidReference::query()->delete();

        return redirect()->route('reference.index');
    }

    public function export()
    {

        $data = UnValidReference::select('name', 'code')->get();
        return Excel::download(new UnValidReferenceExport($data), 'unValid.xlsx');
    }
}
