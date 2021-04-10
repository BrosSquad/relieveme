<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Check;
use App\Models\User;

class CheckService
{
    public function create(int $status, int $checkpointId, string $userIdentifier): Check|bool
    {
        $user = User::whereIdentifier($userIdentifier)->firstOrFail();

        $check = $this->findCheckByCheckpointIdAndUserId($checkpointId, $user->id);

        if ($check === false) {
            return Check::query()
                ->create(
                    [
                        'status' => $status,
                        'user_id' => $user->id,
                        'checkpoint_id' => $checkpointId
                    ]
                );
        }

        return false;
    }

    public function checkOut(int $checkpointId, string $userIdentifier): bool
    {
       $user = User::whereIdentifier($userIdentifier)->firstOrFail();

       $check = $this->findCheckByCheckpointIdAndUserId($checkpointId, $user->id);

       if ($check === false) {
           return false;
       }

       return $check->delete();
    }

    private function findCheckByCheckpointIdAndUserId(int $checkpointId, int $userId): Check|bool
    {
        $check = Check::query()
            ->where(
                [
                    [
                        'user_id',
                        '=',
                        $userId,
                    ],
                    [
                        'checkpoint_id',
                        '=',
                        $checkpointId
                    ],
                ]
            )->first();

        return $check === null ? false : $check;
    }
}
