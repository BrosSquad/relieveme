<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TransportFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use MStaack\LaravelPostgis\Eloquent\Builder;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

/**
 * App\Models\Transport
 *
 * @property int $id
 * @property mixed $location
 * @property string $type
 * @property string $phone_numbers
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static TransportFactory factory(...$parameters)
 * @method static Builder|Transport newModelQuery()
 * @method static Builder|Transport newQuery()
 * @method static Builder|Transport query()
 * @method static Builder|Transport whereCreatedAt(Carbon $value)
 * @method static Builder|Transport whereDescription(string | null $value)
 * @method static Builder|Transport whereId(int $value)
 * @method static Builder|Transport whereLocation(Point $value)
 * @method static Builder|Transport wherePhoneNumbers(string $value)
 * @method static Builder|Transport whereType(string $value)
 * @method static Builder|Transport whereUpdatedAt(Carbon | null $value)
 * @mixin Eloquent
 */
class Transport extends Model
{
    use HasFactory, PostgisTrait;

    public const TYPE_BUS = 'autobus';
    public const TYPE_VAN = 'kombi';
    public const TYPE_HELICOPTER = 'helikopter';

    /**
     * @var string[]
     */
    protected $fillable = [
        'location',
        'type',
        'phone_numbers',
        'description'
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
}
