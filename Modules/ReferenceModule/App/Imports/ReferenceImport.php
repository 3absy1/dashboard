<?php

namespace Modules\ReferenceModule\App\Imports;

use Modules\ReferenceModule\App\Models\ExcelData;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\ReferenceModule\App\Models\Reference;
use Illuminate\Support\Facades\Validator;
use Modules\ReferenceModule\App\Models\ValidReference;
use Modules\ReferenceModule\App\Models\WasteReference;

class ReferenceImport implements ToModel , WithHeadingRow
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
            $this->code => 'required|unique:valid_references,code|unique:references,code',
        ];

        $validator = Validator::make($row, $rules);
        if ($validator->fails()) {
            if (empty($row[$this->name])) {
                return new WasteReference([
                    'code' =>$row[$this->code],
                    'reason'=>"name is required.",
                ]);
            }

            if (empty($row[$this->code])) {
                return new WasteReference([
                    'name' =>$row[$this->name],
                    'reason'=>"code is required.",


                ]);
            }elseif (ValidReference::where('code', $row[$this->code])->exists()) {
                $reference = ValidReference::where('code', $row[$this->code])->first();
                    $reference->flag = 1;
                    $reference->save();

                return new WasteReference([
                    'name' =>$row[$this->name],
                    'code' =>$row[$this->code],
                    'reason'=>"code must be unique.",

                ]);
            }
            elseif (Reference::where('code', $row[$this->code])->exists()) {
                return new WasteReference([
                    'name' =>$row[$this->name],
                    'code' =>$row[$this->code],
                    'reason'=>"This Reference exists before",

                ]);
            }

        }
        return new ValidReference([
            'name' =>$row[$this->name],
            'code' =>$row[$this->code],
        ]);

        }


    }
