<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;

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

    protected $postgisFields = [
        'location',
    ];

    protected $postgisTypes = [
        'location' => [
            'geomtype' => 'geography',
            'srid' => 4326
        ],
    ];

    public function helps()
    {
        return $this->belongsToMany(Help::class, 'checkpoint_helps');
    }
}
