<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Export implements ShouldAutoSize, FromCollection, WithHeadings, WithStyles, WithHeadingRow
{

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true);
        $sheet->getStyle('A1:Z1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:Z1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
       
    }
    public function collection()
    {
        $data = $this->data;
        $i = 1;
        $datas = [];
        foreach ($data['datas'] as $keys => $values) {
            foreach ($data['arr_field'] as $key => $value) {
                if ($value['table']) {
                    $datas[$keys]['no'] = $i;
                    $datas[$keys][$key] = $values[$key];
                }
            }
            $i++;
        }

        return collect($datas);
    }

    public function headings(): array
    {

        $data = $this->data;

        $heading[] = 'No.';
        foreach ($data['arr_field'] as $key => $value) {
            if ($value['table']) {
                $heading[] = $value['label'];
            }
        }
        return $heading;
    }
}
