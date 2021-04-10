<?php

declare(strict_types=1);

namespace App\Services;


use App\Jobs\SendNotificationsToUsers;
use App\Models\Hazard;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use MStaack\LaravelPostgis\Geometries\Point;

class HazardService
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }

    public function getAll($perPage, $page): LengthAwarePaginator
    {
        return Hazard::paginate($perPage, [], 'page', $page);
    }

    public function get($id): Model|Collection|array|Hazard|null
    {
        return Hazard::find($id);
    }


    public function create(array $data): Model|Hazard
    {
        $hazard = Hazard::create(
            [
                'danger' => $data['danger'],
                'level' => $data['level'],
                'location' => new Point($data['location']['lat'], $data['location']['lng']),
                'radius' => $data['radius'],
            ]
        );

        $hazard->save();

        SendNotificationsToUsers::dispatch($hazard)
            ->allOnQueue('listeners')
            ->delay(now()->addSeconds(10));

        return $hazard;
    }

    public function delete($id)
    {
        return Hazard::destroy($id);
    }
}
