<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkpoints', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)
                ->nullable(false)
                ->unique();
            // $table->geometry('geolocation');
            $table->integer('capacity')->nullable(true);
            $table->string('phone_numbers');
            $table->string('description', 200)->nullable(true);
            $table->integer('people_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkpoints');
    }
}
