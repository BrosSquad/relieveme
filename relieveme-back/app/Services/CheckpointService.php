<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Checkpoint;
use Illuminate\Database\Eloquent\Collection;
use MStaack\LaravelPostgis\Geometries\Point;

class CheckpointService
{
    /**
     * Returns all checkpoints.
     *
     * @return Collection
     */
    public function getCheckpoints(): Collection
    {
        return Checkpoint::all();
    }

    /**
     * Returns a checkpoint or throws an exception.
     *
     * @param int $id
     *
     * @return Checkpoint
     */
    public function getCheckpoint(int $id): Checkpoint
    {
        return Checkpoint::findOrFail($id);
    }

    /**
     * Creates new checkpoint.
     *
     * @param array $data
     *
     * @return Checkpoint
     */
    public function createCheckpoint(array $data): Checkpoint
    {
        $point = new Point($data['location']['latitude'], $data['location']['longitude']);

        $data['location'] = $point;

        return Checkpoint::create([
            'name' => $data['name'],
            'location' => $point,
            'capacity' => $data['capacity'],
            'phone_numbers' => $data['phone_numbers'],
            'description' => array_key_exists('description', $data),
        ]);
    }

    /**
     * Returns a flag if checkpoint is deleted or not.
     *
     * @param int $id
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function deleteCheckpoint(int $id): bool
    {
        /** @var Checkpoint $checkpoint */
        $checkpoint = Checkpoint::findOrFail($id);

        return $checkpoint->delete();
    }
}
