<?php

namespace Modules\ReferenceModule\App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\ReferenceModule\App\Models\Reference;
use Modules\ReferenceModule\App\Models\Related;
use Illuminate\Support\Facades\Validator;

class RelatedImport implements ToModel , WithHeadingRow
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
            $this->code => 'required',
        ];

        $validator = Validator::make($row, $rules);
        if ($validator->fails()) {
            return;
        }

        return new Related([
            'name' =>$row[$this->name],
            'code' =>$row[$this->code],
        ]);
    }
}
