<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MeasurementsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = \Faker\Factory::create();
        $autorsIDs = \DB::table('users')->get()->pluck('id');

        \DB::table('measurements')->truncate();

        $params = [
            '11:00' => [
                'top_left_sensor' => 970,
                'top_right_sensor' => 930,
                'bottom_left_sensor' => 902,
                'bottom_right_sensor' => 890,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
            '12:00' => [
                'top_left_sensor' => 993,
                'top_right_sensor' => 973,
                'bottom_left_sensor' => 997,
                'bottom_right_sensor' => 929,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
            '13:00' => [
                'top_left_sensor' => 988,
                'top_right_sensor' => 913,
                'bottom_left_sensor' => 992,
                'bottom_right_sensor' => 912,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
            '14:00' => [
                'top_left_sensor' => 976,
                'top_right_sensor' => 949,
                'bottom_left_sensor' => 984,
                'bottom_right_sensor' => 893,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
            '15:00' => [
                'top_left_sensor' => 853,
                'top_right_sensor' => 890,
                'bottom_left_sensor' => 864,
                'bottom_right_sensor' => 617,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
            '16:00' => [
                'top_left_sensor' => 710,
                'top_right_sensor' => 715,
                'bottom_left_sensor' => 717,
                'bottom_right_sensor' => 340,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
            '17:00' => [
                'top_left_sensor' => 530,
                'top_right_sensor' => 427,
                'bottom_left_sensor' => 521,
                'bottom_right_sensor' => 170,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
            '18:00' => [
                'top_left_sensor' => 400,
                'top_right_sensor' => 210,
                'bottom_left_sensor' => 380,
                'bottom_right_sensor' => 90,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
            '19:00' => [
                'top_left_sensor' => 237,
                'top_right_sensor' => 147,
                'bottom_left_sensor' => 203,
                'bottom_right_sensor' => 30,
                'vertical_engine' => rand(1060, 1120),
                'horizontal_engine' => rand(1060, 1120),
            ],
        ];
        $id = 0;
        foreach ($params as $key => $value) {
            \DB::table('measurements')->insert([
                'priority' => $id,
                'title' => 'Optimizacija ' . $key,
                'user_id' => $autorsIDs->random(),
                'status' => 1,
                'top_left_sensor' => $value['top_left_sensor'],
                'top_right_sensor' => $value['top_right_sensor'],
                'bottom_left_sensor' => $value['bottom_left_sensor'],
                'bottom_right_sensor' => $value['bottom_right_sensor'],
                'vertical_engine' => 90,
                'horizontal_engine' => 60,
                'created_at' => date('Y-m-d H:i:s', strtotime("30.09.2021.")),
                'updated_at' => date('Y-m-d H:i:s', strtotime("30.09.2021."))
            ]);
            $id++;
        }

    }

}
