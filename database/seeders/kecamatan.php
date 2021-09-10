<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class kecamatan extends Seeder
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
                'name' => "Bambanglipuro",
            ],
            [
                'name' => "Banguntapan",
            ],
            [
                'name' => "Bantul",
            ],
        ];
        DB::table('t_kecamatan')->insert($data);
    }
}
