<?php

use Illuminate\Database\Seeder;

class CowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\cows::class, 50)->create();
    }
}
