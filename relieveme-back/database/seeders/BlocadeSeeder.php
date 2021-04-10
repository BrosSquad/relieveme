<?php

namespace Database\Seeders;

use App\Models\Blocade;
use Illuminate\Database\Seeder;

class BlocadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blocade::factory(10)->create();
    }
}
