<?php

namespace Modules\ReferenceModule\App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\ReferenceModule\App\Models\CheckData;


class CheckExport implements FromCollection,WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return  CheckData::select('name', 'code','reference_name','code2', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'name',
            'code',
            'reference',
            'code2',
            'Created At',

    ];
    }

}
