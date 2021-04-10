<?php

namespace Database\Seeders;

use App\Models\CheckpointHelp;
use Illuminate\Database\Seeder;

class CheckpointHelpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CheckpointHelp::factory(10)->create();
    }
}
