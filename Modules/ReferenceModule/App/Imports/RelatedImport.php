<?php

namespace Modules\ReferenceModule\App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\ReferenceModule\App\Models\Reference;
use Modules\ReferenceModule\App\Models\Related;
use Illuminate\Support\Facades\Validator;

class RelatedImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public $name;
    public $code;

    public $reference_code;
    public function __construct($name, $code, $reference_code)
    {
        $this->name = $name;
        $this->code = $code;
        $this->reference_code = $reference_code;
    }
    public function model(array $row)
    {

        $rules = [
            $this->name => 'required',
            $this->code => 'required|unique:related,code|unique:references,code',
            $this->reference_code => '',
        ];
        $validator = Validator::make($row, $rules);
        if ($validator->fails()) {
            return;
        }
        if (empty($row[$this->reference_code])) {
            return new Related([
                'name' => $row[$this->name],
                'code' => $row[$this->code],
                'reference_id' =>null,
            ]);
        }

        $reference = Reference::where('code', $row[$this->reference_code])->first();

        if ($reference) {
            return new Related([
                'name' => $row[$this->name],
                'code' => $row[$this->code],
                'reference_id' => $reference->id,
                'flag' => 1,
            ]);
        }



        return new Related([
            'name' => $row[$this->name],
            'code' => $row[$this->code],
            'reference_id' => $row[$this->reference_code],

        ]);
    }
}
