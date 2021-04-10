<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SuggestionsService
{
    public function get(int $id)
    {
        return Suggestion::query()->findOrFail($id);
    }

    public function getAll(): Collection
    {
        return Suggestion::query()
            ->orderBy('id')
            ->get();
    }

    public function create(string $name, int $hazardId): Builder|Suggestion
    {
        return Suggestion::query()
            ->create(
                [
                    'name' => $name,
                    'hazard_id' => $hazardId,
                ]
            );
    }

    public function update(int $id, string $name): bool
    {
        $suggeston = Suggestion::query()->findOrFail($id);

        return $suggeston->update(
            [
                'name' => $name
            ]
        );
    }

    public function delete(int $id): bool
    {
        $suggestion = Suggestion::query()->findOrFail($id);

        return $suggestion->delete();
    }
}
