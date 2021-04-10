<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ExpoFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Expo
 *
 * @property-read User $user
 * @method static ExpoFactory factory(...$parameters)
 * @method static Builder|Expo newModelQuery()
 * @method static Builder|Expo newQuery()
 * @method static Builder|Expo query()
 * @mixin Eloquent
 * @property int $id
 * @property string $token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 * @method static Builder|Expo whereCreatedAt(Carbon $value)
 * @method static Builder|Expo whereId(int $value)
 * @method static Builder|Expo whereToken(string $value)
 * @method static Builder|Expo whereUpdatedAt(Carbon $value)
 * @method static Builder|Expo whereUserId(int $value)
 */
class Expo extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'user_id'
    ];

    /**
     * Get user related to token.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
