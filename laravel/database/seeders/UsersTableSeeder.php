<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    protected $tablename;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        // GET TABLE NAME
        $this->tablename = (new User())->getTable();

        // TRUNCATE TABLE
        $this->command->info('Truncating ' . $this->tablename);
        \DB::table($this->tablename)->truncate();

        // SEED TABLE
        $rows = 2;
        $this->command->info('Creating ' . $rows . ' rows');
        $bar = $this->command->getOutput()->createProgressBar();
        $bar->start();

        \DB::table('users')->insert([
            'status' => 1,
            'name' => 'Danilo Strahinovic',
            'email' => 'danilo.strahinovic@gmail.com',
            'password' => \Hash::make('danilo123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $bar->advance(1);
        \DB::table('users')->insert([
            'status' => 0,
            'name' => 'Sara Bircanin',
            'phone' => '0649876541',
            'email' => 'sara.bircanin@gmail.com',
            'password' => bcrypt('sara123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $bar->finish();
    }

}
