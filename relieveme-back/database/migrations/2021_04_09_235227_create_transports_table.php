<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            // TODO: Should we go with geometry or point?
//            $table->geometry('geolocation');
            $table->enum('type', ['helikopter', 'kombi', 'autobus']);
            $table->string('phone_numbers');
            $table->string('description', 200)->nullable(true);
            // TODO: Add postgix index
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
        Schema::dropIfExists('transports');
    }
}
