<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MStaack\LaravelPostgis\Schema\Blueprint;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'transports',
            function (Blueprint $table) {
                $table->id();
                $table->point('location')->nullable(false);
                $table->enum('type', ['helikopter', 'kombi', 'autobus']);
                $table->string('phone_numbers', 200)->nullable(false);
                $table->string('description', 200)->nullable(true);
                $table->timestamps();
                $table->spatialIndex('location');
            }
        );
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
