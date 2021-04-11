<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions;
use App\Events\CheckpointEvent;
use App\Models\Check;
use App\Models\Checkpoint;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class CalculatePeopleCountInCheckPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calc:count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates the people count in checkpoints';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        Checkpoint::query()->chunk(
            200,
            function (Collection $checkpoints) {
                /** @var Checkpoint $checkpoint */
                foreach ($checkpoints as $checkpoint) {
                    $checks = Check::query()
                        ->where('checkpoint_id', $checkpoint->id)
                        ->sum('status');

                    if ($checks < 0) {
                        $checks = 0;
                    }

                    $checkpoint->people_count = $checks;
                    $checkpoint->save();

                    broadcast(new CheckpointEvent($checks, Actions::UPDATED));
                }
            }
        );

        return 0;
    }
}
