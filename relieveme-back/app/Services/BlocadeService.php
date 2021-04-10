<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Blocade;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use MStaack\LaravelPostgis\Geometries\Point;

class BlocadeService
{
    /**
     * Get blocades.
     *
     * @return Collection|array
     */
    public function getBlocades(): Collection|array
    {
        return Blocade::all();
    }

    /**
     * Get specific blocade.
     *
     * @param int $id
     *
     * @return Blocade
     */
    public function getBlocade(int $id): Blocade
    {
        return Blocade::whereId($id)->firstOrFail();
    }

    /**
     * Creates a blocade.
     *
     * @param array $data
     *
     * @return Blocade
     */
    public function createBlocade(array $data): Blocade
    {
        return Blocade::create([
            'name' => $data['name'],
            'location' => new Point(
                $data['location']['latitude'],
                $data['location']['longitude']
            ),
            'hazard_id' => $data['hazard_id']
        ]);
    }

    /**
     * Deletes a specific blocade.
     *
     * @param int $id
     *
     * @return bool
     *
     * @throws Exception
     */
    public function deleteBlocade(int $id): bool
    {
        $blocade = Blocade::whereId($id)->firstOrFail();

        return $blocade->delete();
    }
}
