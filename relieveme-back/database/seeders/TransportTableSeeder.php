<?php

namespace Database\Seeders;

use App\Models\Transport;
use Illuminate\Database\Seeder;

class TransportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transport::factory(10)->create();
    }
}
