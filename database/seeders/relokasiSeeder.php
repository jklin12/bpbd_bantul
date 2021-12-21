<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class relokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('t_relokasi')->insert([
                'relokasi_tanggal' => date('Y-m-d', strtotime('now +' . $faker->unique()->numberBetween(1, 15) . ' days')),
                'relokasi_name' => $faker->name,
                'relokasi_asal' => $faker->Address,
                'relokasi_luas' => $faker->numberBetween(100, 1500),
                'relokasi_jumlah_jiwa' =>   $faker->numberBetween(1, 10),
                'relokasi_status_tanah' =>  '',
                "relokasi_sarana_prasarana" =>  '',
                'relokasi_lokasi' => '',
                'relokasi_keterangan' =>   '',   
                'created_at' => date('Y-m-d'),
            ]);
        }
    }
}
