<?php

use Illuminate\Database\Seeder;

class DailyMilkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\daily_milk::class, 500)->create();
    }
}
