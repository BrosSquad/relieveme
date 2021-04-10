<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckpointHelp extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'checkpoint_id',
        'help_id'
    ];
}
