<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorsTableSeeder extends Seeder
{
    protected $tablename;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // GET TABLE NAME
        $this->tablename = (new Color())->getTable();

        // TRUNCATE TABLE
        $this->command->info('Truncating ' . $this->tablename);
        \DB::table($this->tablename)->truncate();

        // SEED TABLE
        $rows = 10;
        $this->command->info('Creating ' . $rows . ' rows');
        $bar = $this->command->getOutput()->createProgressBar();
        $bar->start();
        for ($i = 1; $i <= $rows; $i++) {
            Color::factory()
                ->create();
            $bar->advance(1);
        }
        $bar->finish();
    }
}
