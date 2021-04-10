<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;

class Blocade extends Model
{
    use HasFactory, PostgisTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'location',
        'hazard_id'
    ];

    /**
     * @var string[]
     */
    protected $postgisFields = [
        'location',
    ];

    /**
     * @var string[]
     */
    protected $postgisTypes = [
        'location' => [
            'geomtype' => 'geography',
            'srid' => 4326
        ],
    ];

    /**
     * Get hazard related to Blocade.
     *
     * @return BelongsTo
     */
    public function hazard(): BelongsTo
    {
        return $this->belongsTo(Hazard::class);
    }
}
