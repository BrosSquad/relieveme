<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Expo;
use App\Models\User;
use App\Models\UserLocationHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MStaack\LaravelPostgis\Geometries\Point;

class UserService
{
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

                $expo = new Expo(['token' => $expoToken]);

                $user->locations()->save($userLocation);
                $user->toknes()->save($expo);

                return $user;
            }
        );
    }
}
