<?php

namespace Database\Seeders;

use App\Models\Checkpoint;
use App\Models\Help;
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
        $checkpoints = Checkpoint::all();
        $helps = Help::all();
    }
}
