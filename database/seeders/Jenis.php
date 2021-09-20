<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Jenis extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'railing'
            ],
            [
                'name' => 'abudment'
            ],
            [
                'name' => 'talud sungai '
            ],
            [
                'name' => 'Talud pengaman jalan'
            ],
        ];

        DB::table('t_jenis')->insert($data);
    }
}
