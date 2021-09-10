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
                'kecamatan' => $faker->numberBetween(1, 10),
                'kelurahan' => $faker->numberBetween(1, 10),
                'deskripsi' => $faker->text,
                'type' => $faker->numberBetween(1, 5),
                'size' =>  "10 x 10 m",
                'foto' => $faker->imageUrl(350, 350),
                'alamat' =>   $faker->address,
            ]);
        }
        // \App\Models\User::factory(10)->create();

    }
}
