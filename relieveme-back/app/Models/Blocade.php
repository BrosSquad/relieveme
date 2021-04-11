<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\BlocadeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use MStaack\LaravelPostgis\Eloquent\Builder;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

/**
 * App\Models\Blocade
 *
 * @property int $id
 * @property string $name
 * @property Point $location
 * @property int $hazard_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Hazard $hazard
 * @method static BlocadeFactory factory(...$parameters)
 * @method static Builder|Blocade newModelQuery()
 * @method static Builder|Blocade newQuery()
 * @method static Builder|Blocade query()
 * @method static Builder|Blocade whereCreatedAt(Carbon $value)
 * @method static Builder|Blocade whereHazardId(int $value)
 * @method static Builder|Blocade whereId(int $value)
 * @method static Builder|Blocade whereLocation(Point $value)
 * @method static Builder|Blocade whereName(string $value)
 * @method static Builder|Blocade whereUpdatedAt(Carbon | null $value)
 *
 * @mixin Eloquent
 */
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
