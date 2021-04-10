<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserLocationHistory;
use Illuminate\Database\Seeder;

class UserLocationHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        UserLocationHistory::factory(10)->create();
    }
}
