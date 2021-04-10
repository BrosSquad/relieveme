<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Blocade;
use Illuminate\Database\Eloquent\Collection;

class BlocadeService
{
    /**
     * @return Collection|array
     */
    public function getBlocade(): Collection|array
    {
        return Blocade::all();
    }
}
