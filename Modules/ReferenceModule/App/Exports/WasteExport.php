<?php

namespace Modules\ReferenceModule\App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\ReferenceModule\App\Models\WasteReference;

class WasteExport implements FromCollection,WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return  WasteReference::select('name', 'code')->get();


    }

    public function headings(): array
    {
        return [
            'name',
            'code',

    ];
    }

}
