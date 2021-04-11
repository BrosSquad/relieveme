<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions;
use App\Models\User;
use App\Models\Check;
use App\Events\CheckEvent;

class CheckService
{
    public function create(int $status, int $checkpointId, string $userIdentifier): Check|bool
    {
        $user = User::whereIdentifier($userIdentifier)->firstOrFail();

        $check = $this->findCheckByCheckpointIdAndUserId($checkpointId, $user->id);

        if ($check === false) {
            $check = Check::query()
                ->create(
                    [
                        'status' => $status,
                        'user_id' => $user->id,
                        'checkpoint_id' => $checkpointId
                    ]
                );

            broadcast(new CheckEvent($checkpointId, Actions::CREATED));

            return $check;
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

        $deleted = $check->delete();

        broadcast(new CheckEvent($checkpointId, Actions::DELETED));

        return $deleted;
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
