<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('t_bencana')->insert([
                'kecamatan' => $faker->numberBetween(1, 3),
                'kelurahan' => $faker->numberBetween(1, 9),
                'deskripsi' => $faker->text,
                'type' => $faker->numberBetween(1, 7),
                'panjang' =>   $faker->numberBetween(1, 10),
                'lebar' =>  $faker->numberBetween(1, 10),
                "tinggi" =>  $faker->numberBetween(1, 10),
                'foto' => '',
                'alamat' =>   $faker->address,
                'created_at' => date('Y-m-d', strtotime('now +' . $faker->unique()->numberBetween(1, 15) . ' days'))


            ]);
        }
        // \App\Models\User::factory(10)->create();

    }
}
