<?php

namespace App\Exports;

use App\Models\MBencana;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromCollection,WithHeadings
{

    private $data ;

    public function __construct(array $data) 
    {
        $this->data = $data;
    }
    public function collection()
    {
 
        return MBencana::all();
    }

    public function headings(): array
    {

        $data = $this->data;

        $heading = [];
        foreach ($data['arr_field'] as $key => $value) {
            $heading[$key] = $key;
        }

        print_r($heading);
        die();

        return [
            '#',
            'User',
            'Date',
        ];
    }
}
