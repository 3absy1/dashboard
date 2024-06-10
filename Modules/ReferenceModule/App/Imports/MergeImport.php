<?php

namespace Modules\ReferenceModule\App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class MergeImport implements ToCollection
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public $entry;


    public $total;

    public function __construct($entry, $total)
    {
        $this->entry = $entry;
        $this->total = $total;
    }
    public function collection(Collection $rows)
    {
        $mergedData = [];

        foreach ($rows as $row) {
            $entryNumbers = array_map(function ($col) use ($row) {
                return $row[$col];
            }, $this->entry);

            $entryNumber = implode('-', $entryNumbers);

            $totalAmount = array_sum(array_map(function ($col) use ($row) {
                return $row[$col];
            }, $this->total));

            if (isset($mergedData[$entryNumber])) {
                $mergedData[$entryNumber]['total'] += $totalAmount;
                $mergedData[$entryNumber]['rows'][] = $row->toArray(); // Store the rows
                dd($row->toArray());
            } else {
                $mergedData[$entryNumber] = [
                    'entry_number' => $entryNumber,
                    'total' => $totalAmount,
                    'rows' => [$row->toArray()], // Initialize array with current row

                ];
            }
        }
    }
}
