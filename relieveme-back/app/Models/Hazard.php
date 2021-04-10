<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\HazardFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use MStaack\LaravelPostgis\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use Illuminate\Database\Eloquent\Model;
use MStaack\LaravelPostgis\Geometries\Point;

/**
 * App\Models\Hazard
 *
 * @property int $id
 * @property string $danger
 * @property int $level
 * @property mixed $location
 * @property int $radius
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static HazardFactory factory(...$parameters)
 * @method static Builder|Hazard newModelQuery()
 * @method static Builder|Hazard newQuery()
 * @method static Builder|Hazard query()
 * @method static Builder|Hazard whereCreatedAt(Carbon $value)
 * @method static Builder|Hazard whereDanger(string $value)
 * @method static Builder|Hazard whereId(int $value)
 * @method static Builder|Hazard whereLevel(int $value)
 * @method static Builder|Hazard whereLocation(Point $value)
 * @method static Builder|Hazard whereRadius(int $value)
 * @method static Builder|Hazard whereUpdatedAt(Carbon $value)
 * @mixin Eloquent
 *
 * @property-read Collection|Suggestion[] $suggestions
 * @property-read int|null $suggestions_count
 */
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

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class, 'hazard_id', 'id');
    }
}
