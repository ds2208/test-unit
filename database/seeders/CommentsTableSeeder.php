<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = \Faker\Factory::create();

        \DB::table('comments')->truncate();

        $measurementIDs = \DB::table('measurements')->get()->pluck('id');

        for ($i = 0; $i < 60; $i++) {
            \DB::table('comments')->insert([
                'name' => $faker->firstName,
                'email' => $faker->email,
                'content' => $faker->paragraph,
                'measurement_id' => $measurementIDs->random(),
                'index' => random_int(0, 1),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

}
