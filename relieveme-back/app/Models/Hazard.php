<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use Illuminate\Database\Eloquent\Model;

class Hazard extends Model
{
    use HasFactory, PostgisTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'danger',
        'level',
        'location'
    ];

    protected $postgisFields = [
        'location',
    ];

    protected $postgisTypes = [
        'location' => [
            'geomtype' => 'geography',
            'srid' => 4326
        ],
    ];

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class, 'hazard_id', 'id');
    }
}
