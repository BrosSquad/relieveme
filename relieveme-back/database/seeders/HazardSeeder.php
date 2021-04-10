<?php

namespace Database\Seeders;

use App\Models\Hazard;
use Illuminate\Database\Seeder;

class HazardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hazard::factory(10)->create();
    }
}
