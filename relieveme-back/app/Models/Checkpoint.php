<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CheckpointFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use MStaack\LaravelPostgis\Eloquent\Builder;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

/**
 * App\Models\Checkpoint
 *
 * @property int $id
 * @property string $name
 * @property Point $location
 * @property int $capacity
 * @property string $phone_numbers
 * @property string|null $description
 * @property int $people_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Help[] $helps
 * @property-read int|null $helps_count
 * @method static CheckpointFactory factory(...$parameters)
 * @method static Builder|Checkpoint newModelQuery()
 * @method static Builder|Checkpoint newQuery()
 * @method static Builder|Checkpoint query()
 * @method static Builder|Checkpoint whereCapacity(int $value)
 * @method static Builder|Checkpoint whereCreatedAt(Carbon $value)
 * @method static Builder|Checkpoint whereDescription(string $value)
 * @method static Builder|Checkpoint whereId(int $value)
 * @method static Builder|Checkpoint whereLocation(Point $value)
 * @method static Builder|Checkpoint whereName(string $value)
 * @method static Builder|Checkpoint wherePeopleCount(int $value)
 * @method static Builder|Checkpoint wherePhoneNumbers(string $value)
 * @method static Builder|Checkpoint whereUpdatedAt(Carbon $value)
 *
 * @mixin Eloquent
 */
class Checkpoint extends Model
{
    use HasFactory, PostgisTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'location',
        'capacity',
        'phone_numbers',
        'description',
        'people_count'
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
     * Get all helps related to Checkpoint.
     *
     * @return BelongsToMany
     */
    public function helps(): BelongsToMany
    {
        return $this->belongsToMany(Help::class, 'checkpoint_help');
    }

    public function checks(): HasMany
    {
        return $this->hasMany(Check::class, 'checkpoint_id', 'id');
    }
}
