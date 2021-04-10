<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\UserLocationHistory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteUserLocationHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes users locations from the database';

    protected int $keepLast = 5;

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
        $userIds = UserLocationHistory::query()
            ->groupBy('user_id')
            ->havingRaw('COUNT(*) > ?', [$this->keepLast])
            ->get('user_id');

        $sql = <<<SQL
                DELETE
                FROM user_location_histories
                WHERE id NOT IN (
                    SELECT id FROM user_location_histories WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 5
                );
            SQL;

        foreach ($userIds as $userId) {
            DB::delete($sql, ['user_id' => $userId->user_id]);
        }

        return 0;
    }
}
