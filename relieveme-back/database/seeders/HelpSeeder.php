<?php

namespace Database\Seeders;

use App\Models\Checkpoint;
use App\Models\Help;
use Illuminate\Database\Seeder;

class HelpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            /** @type Help $help */
            $help = Help::factory()->create();

             Checkpoint::whereId($i)->first()->helps()->attach($help->id);
        }
    }
}
