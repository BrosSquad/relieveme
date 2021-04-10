<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\UserLocationHistory;
use MStaack\LaravelPostgis\Geometries\Point;
use NotificationChannels\ExpoPushNotifications\ExpoChannel;

class UserService
{
    public function __construct(private ExpoChannel $expoChannel)
    {
    }

    public function createUser(array $data): User
    {
        $location = $data['location'];
        $expoToken = $data['expo'];

        return DB::transaction(
            function () use ($location, $expoToken) {
                $user = User::create(['identifier' => Str::random(32)]);
                $userLocation = new UserLocationHistory(
                    [
                        'location' => new Point($location['lat'], $location['lng']),
                    ]
                );

                $user->locations()->save($userLocation);

                $this->expoChannel->expo->subscribe($user->id, $expoToken);

                return $user;
            }
        );
    }
}
