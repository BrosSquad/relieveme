<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CheckFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Check
 *
 * @property int $id
 * @property int $status
 * @property int $user_id
 * @property int $checkpoint_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CheckFactory factory(...$parameters)
 * @method static Builder|Check newModelQuery()
 * @method static Builder|Check newQuery()
 * @method static Builder|Check query()
 * @method static Builder|Check whereCheckpointId(int $value)
 * @method static Builder|Check whereCreatedAt(Carbon $value)
 * @method static Builder|Check whereId(int $value)
 * @method static Builder|Check whereStatus(int $value)
 * @method static Builder|Check whereUpdatedAt(Carbon $value)
 * @method static Builder|Check whereUserId(int $value)
 * @mixin Eloquent
 */
class Check extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'status',
        'user_id',
        'checkpoint_id'
    ];
}
