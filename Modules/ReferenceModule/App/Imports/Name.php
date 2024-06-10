<?php

namespace Modules\ReferenceModule\App\Imports;

use Modules\ReferenceModule\App\Models\CheckData;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\ReferenceModule\App\Models\Reference;
use Modules\ReferenceModule\App\Models\Related;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;


class Name implements ToModel, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null


     */

    public $name;
    public $code;

    public function __construct($name, $code)
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


        $reference = Reference::where('name', $row[$this->name])->first();
        $related = Related::where('name', $row[$this->name])->first();

        if ($reference) {
            CheckData::create([
                'name' => $row[$this->name],
                'code' => $row[$this->code],
                'reference_name' => $reference->name,
                'code2' => $reference->code,
            ]);

            $excel = CheckData::where('code', $row[$this->code])->first();
            $excel->type = 'reference';
            $excel->save();

        }

        if ($related) {
                $referenceOfrelated = Reference::find($related->reference_id);

                    CheckData::create([
                        'name' => $row[$this->name],
                        'code' => $row[$this->code],
                        'reference_name' => $referenceOfrelated ? $referenceOfrelated->name : 'N/A',
                        'code2' => $referenceOfrelated ? $referenceOfrelated->code : 'N/A',
                    ]);

                    $excel = CheckData::where('code', $row[$this->code])->first();
                    $excel->type = 'related';
                    $excel->save();

            } else {
                CheckData::create([
                    'name' => $row[$this->name],
                    'code' => $row[$this->code],
                    'reference_name' => null,
                    'code2' => null,
                    'type' => null
                ]);
            }
        }
    }

