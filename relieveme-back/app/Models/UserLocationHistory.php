<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserLocationHistoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use MStaack\LaravelPostgis\Eloquent\Builder;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

/**
 * App\Models\UserLocationHistory
 *
 * @method static UserLocationHistoryFactory factory(...$parameters)
 * @method static Builder|UserLocationHistory newModelQuery()
 * @method static Builder|UserLocationHistory newQuery()
 * @method static Builder|UserLocationHistory query()
 * @mixin Eloquent
 * @property int $id
 * @property Point $location
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserLocationHistory whereCreatedAt(Carbon $value)
 * @method static Builder|UserLocationHistory whereId(int $value)
 * @method static Builder|UserLocationHistory whereLocation(Point $value)
 * @method static Builder|UserLocationHistory whereUpdatedAt(Carbon | null $value)
 * @method static Builder|UserLocationHistory whereUserId(string $value)
 */
class UserLocationHistory extends Model
{
    use HasFactory, PostgisTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'location',
        'user_id'
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
}
