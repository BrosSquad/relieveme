<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SuggestionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Suggestion
 *
 * @property int $id
 * @property string $name
 * @property int $hazard_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static SuggestionFactory factory(...$parameters)
 * @method static Builder|Suggestion newModelQuery()
 * @method static Builder|Suggestion newQuery()
 * @method static Builder|Suggestion query()
 * @method static Builder|Suggestion whereCreatedAt(Carbon $value)
 * @method static Builder|Suggestion whereHazardId(int $value)
 * @method static Builder|Suggestion whereId(int $value)
 * @method static Builder|Suggestion whereName(string $value)
 * @method static Builder|Suggestion whereUpdatedAt(Carbon | null $value)
 * @mixin Eloquent
 */
class Suggestion extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'hazard_id'
    ];

    public function hazard(): BelongsTo
    {
        return $this->belongsTo(Hazard::class, 'hazard_id', 'id');
    }
}
