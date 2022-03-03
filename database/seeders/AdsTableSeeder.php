<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            [
                'priority' => 0,
                'title' => "PROJECT HUB | ARDUINO CC",
                'button_title' => "ARDUINO CC",
                'url' => 'https://store.arduino.cc/',
                'photo' => 'ad-two.jpg'
            ], [
                'priority' => 1,
                'title' => "THE IOT PROJECTS | SERVO ENGINES",
                'button_title' => "LINK",
                'url' => 'https://theiotprojects.com/',
                'photo' => 'ad-four.jpg'
            ], [
                'priority' => 2,
                'title' => "MICROCONTROLLERS LABORATORY | SERVER SYSTEMS",
                'button_title' => "SERVERS",
                'url' => 'https://microcontrollerslab.com/',
                'photo' => 'ad-five.jpg'
            ],
        ];

        \DB::table('ads')->truncate();

        foreach ($ads as $ad) {
            \DB::table('ads')->insert([
                'priority' => $ad['priority'],
                'title' => $ad['title'],
                'button_title' => $ad['button_title'],
                'photo' => $ad['photo'],
                'url' => $ad['url'],
                'index' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
