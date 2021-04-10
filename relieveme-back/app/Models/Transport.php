<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;

class Transport extends Model
{
    use HasFactory, PostgisTrait;

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
