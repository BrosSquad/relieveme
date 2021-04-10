<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckpointHelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkpoint_help', function (Blueprint $table) {
            $table->primary(['checkpoint_id', 'help_id'], 'checkpoint_help');

            $table->foreignId('checkpoint_id')
                ->constrained('checkpoints')
                ->cascadeOnDelete();

            $table->foreignId('help_id')
                ->constrained('helps')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('checkpoint_help');
    }
}
