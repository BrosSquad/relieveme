<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UsersTableSeeder::class,
                CheckpointSeeder::class,
                HelpSeeder::class,
                TransportTableSeeder::class,
                HazardSeeder::class,
                SuggestionSeeder::class,
                CheckSeeder::class,
                CheckpointHelpSeeder::class,
                BlocadeSeeder::class
            ]
        );
    }
}
