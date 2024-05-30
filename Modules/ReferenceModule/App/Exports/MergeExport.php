<?php

namespace Modules\ReferenceModule\App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\ReferenceModule\App\Models\Merge;

class MergeExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $entry;
    protected $total;

    public function __construct($data,$entry,$total)
    {
        $this->data = $data;
        $this->entry = $entry;
        $this->total = $total;
    }

    public function collection()
    {
        return $this->data;


    }

    public function headings(): array
    {
        $headings = [];

        foreach ($this->entry as $header) {
            $headings[] = $header;
        }

        foreach ($this->total as $header) {
            $headings[] = $header;
        }

        return $headings;
    }

}
