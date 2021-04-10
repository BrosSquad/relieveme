<?php

namespace App\Jobs;

use App\Models\Hazard;
use App\Models\User;
use App\Notifications\NotifyUserAboutHazard;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendNotificationsToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Hazard $hazard)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = DB::select(
            DB::raw(
                <<<SQL
                SELECT DISTINCT (users.*), ulh.created_at
                FROM user_location_histories as ulh
                         INNER JOIN users on users.id = ulh.user_id
                WHERE ST_DWithin(
                              ulh.location,
                              ST_GeomFromText(?, 4326)::geography,
                              ?,
                              true
                          ) AND ulh.created_at BETWEEN NOW() - INTERVAL '7 DAYS' AND NOW()
                ORDER BY ulh.created_at DESC;
                SQL
            ),
            [
                "POINT({$this->hazard->location->getLng()} {$this->hazard->location->getLat()})",
                $this->hazard->radius,
            ]
        );

        collect(
            array_map(
                function ($user) {
                    $u = new User();
                    $u->id = $user->id;
                    $u->identifier = $user->identifier;
                    $u->created_at = $user->created_at;
                    $u->updated_at = $user->updated_at;
                    return $u;
                },
                $users
            )
        )->each(
            fn(User $user) => $user->notify(
                (new NotifyUserAboutHazard($this->hazard))
                    ->delay(now()->addSecond())
            )
        );
    }
}
