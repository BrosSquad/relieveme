<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\HelpFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Help
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static HelpFactory factory(...$parameters)
 * @method static Builder|Help newModelQuery()
 * @method static Builder|Help newQuery()
 * @method static Builder|Help query()
 * @method static Builder|Help whereCreatedAt(Carbon $value)
 * @method static Builder|Help whereId(int $value)
 * @method static Builder|Help whereName(string $value)
 * @method static Builder|Help whereUpdatedAt(Carbon | null $value)
 *
 * @mixin Eloquent
 */
class Help extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];
}
