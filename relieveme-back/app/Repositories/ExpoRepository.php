<?php


namespace App\Repositories;


use App\Models\Expo;

class ExpoRepository implements \ExponentPhpSDK\ExpoRepository
{

    public function store($key, $value): bool
    {
        Expo::create(
            [
                'user_id' => $key,
                'token' => $value
            ]
        );

        return true;
    }

    public function retrieve(string $key)
    {
        return Expo::query()
            ->where('user_id', $key)
            ->get()
            ->pluck('token')
            ->toArray();
    }

    public function forget(string $key, string $value = null): bool
    {
        return Expo::where(
            [
                ['user_id', '=', $key],
                ['token', '=', $value],
            ]
        )
            ->delete();
    }
}
