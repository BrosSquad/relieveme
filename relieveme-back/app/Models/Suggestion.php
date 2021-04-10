<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
