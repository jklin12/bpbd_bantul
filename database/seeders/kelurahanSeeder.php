<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kelurahanSeeder extends Seeder
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
                'kecamatan_id' => "1",
                'name' => "Mulyodadi",
            ],
            [
                'kecamatan_id' => "1",
                'name' => "Sidomulyo",
            ],
            [
                'kecamatan_id' => "1",
                'name' => "Sumbermulyo",
            ],
            [
                'kecamatan_id' => "2",
                'name' => "Banguntapan",
            ],
            [
                'kecamatan_id' => "2",
                'name' => "Baturetno",
            ],
            [
                'kecamatan_id' => "2",
                'name' => "Jagalan",
            ],
            [
                'kecamatan_id' => "2",
                'name' => "Ringinharjo",
            ],
            [
                'kecamatan_id' => "2",
                'name' => "Sabdodadi",
            ],
            [
                'kecamatan_id' => "2",
                'name' => "Trirenggo",
            ],
        ];


        DB::table('t_kelurahan')->insert($data);
    }
}
