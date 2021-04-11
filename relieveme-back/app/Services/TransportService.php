<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions;
use App\Models\Transport;
use App\Events\TransportEvent;
use Illuminate\Support\Collection;
use MStaack\LaravelPostgis\Geometries\Point;

class TransportService
{
    public function get(int $id): Transport
    {
        return Transport::query()->findOrFail($id);
    }

    public function getAll(): Collection
    {
        return Transport::query()->orderBy('id')->get();
    }

    public function create(array $data): Transport
    {
        $location = $data['location'];
        $type = $data['type'];
        $phoneNumbers = $data['phone_numbers'];
        $description = $data['description'] ?? null;

        $point = new Point(
            $location['latitude'],
            $location['longitude'],
        );

        $transport = Transport::query()
            ->create(
                [
                    'location' => $point,
                    'type' => $type,
                    'phone_numbers' => $phoneNumbers,
                    'description' => $description,
                ]
            );

        broadcast(new TransportEvent($transport, Actions::CREATED));

        return $transport;
    }

    public function update(int $id, array $data): bool
    {
        $location = $data['location'];
        $type = $data['type'];
        $phoneNumbers = $data['phone_numbers'];
        $description = $data['description'];

        $point = new Point(
            $location['latitude'],
            $location['longitude'],
        );

        $transport = Transport::query()->findOrFail($id);

        $updated = $transport->update(
            [
                'location' => $point,
                'type' => $type,
                'phone_numbers' => $phoneNumbers,
                'description' => $description,
            ]
        );

        broadcast(new TransportEvent($transport, Actions::UPDATED));

        return $updated;
    }

    public function delete(int $id)
    {
        $transport = Transport::query()->findOrFail($id);

        broadcast(new TransportEvent($transport, Actions::DELETED));

        return $transport->delete();
    }
}
