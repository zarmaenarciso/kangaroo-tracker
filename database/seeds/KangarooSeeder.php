<?php

use Illuminate\Database\Seeder;

class KangarooSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Kangaroo::class, 20)->create();
    }
}
