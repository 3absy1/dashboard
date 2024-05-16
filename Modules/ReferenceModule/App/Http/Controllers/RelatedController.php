<?php

namespace Modules\ReferenceModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\ReferenceModule\App\Models\Related;
use Modules\ReferenceModule\App\Models\Reference;



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
            // dd($request->reference_id);
            Related::create([
                'reference_id'=>$request->reference_id,
                'name'=>$request->name,
                'code'=>$request->code,
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


            public function delete($id)
            {
                Related::destroy($id);
                    return redirect()->route('related');

            }

}
