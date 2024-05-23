<?php

namespace Modules\ReferenceModule\App\Imports;

use Modules\ReferenceModule\App\Models\ExcelData;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\ReferenceModule\App\Models\Reference;
use Modules\ReferenceModule\App\Models\Related;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class Code implements ToModel , WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public$name;
    public $code;
    public function __construct($name,$code)
    {
        $this->name = $name;
        $this->code = $code;


    }
    public function model(array $row)
    {

        $rules = [
            $this->name => 'required',
            $this->code => 'required|numeric',
        ];

        $validator = Validator::make($row, $rules);
        if ($validator->fails()) {
            return;
        }


        $reference = Reference::where('code', $row[$this->code])->first();
        if ($reference) {
            ExcelData::create([
                'name' => $row[$this->name],
                'code' => $row[$this->code],
                'reference_name'=>$reference->name,
                'code2'=>$row[$this->code],
            ]);
        } else {
            $related = Related::where('code', $row[$this->code])->first();

            if ($related) {
                $reference = Reference::find($related->reference_id);

                if ($reference) {
                    ExcelData::create([
                        'name' => $row[$this->name],
                        'code' => $row[$this->code],
                        'code2'=>$reference->code,
                        'reference_name'=>$reference->name
                    ]);
                }
            }
            else{
            ExcelData::create([
                'name' => $row[$this->name],
                'code' => $row[$this->code],
                'reference_name'=>null,
                'code2'=>null

            ]);
        }
        }
    }

}
