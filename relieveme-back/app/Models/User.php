<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $identifier
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|UserLocationHistory[] $locations
 * @property-read int|null $locations_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Expo[] $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt(Carbon $value)
 * @method static Builder|User whereId(int $value)
 * @method static Builder|User whereIdentifier(string $value)
 * @method static Builder|User whereUpdatedAt(Carbon | null $value)
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier'
    ];

    /**
     * Get user's token.
     *
     * @return HasMany
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(Expo::class);
    }

    /**
     * Get user's locations.
     *
     * @return HasMany
     */
    public function locations(): HasMany
    {
        return $this->hasMany(UserLocationHistory::class);
    }

    public function routeNotificationForExpoPushNotifications()
    {
        return (string)$this->id;
    }

    public function checks(): HasMany
    {
        return $this->hasMany(Check::class, 'user_id', 'id');
    }

}
