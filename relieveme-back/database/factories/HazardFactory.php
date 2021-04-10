<?php

namespace Database\Factories;

use App\Models\Hazard;
use MStaack\LaravelPostgis\Geometries\Point;
use MStaack\LaravelPostgis\Geometries\LineString;
use MStaack\LaravelPostgis\Geometries\Polygon;
use Illuminate\Database\Eloquent\Factories\Factory;

class HazardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hazard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $locations = [
            new Polygon(
                [
                    new LineString(
                        [
                            new Point(44.899920, 21.406378),
                            new Point(44.904548, 21.421913),
                            new Point(44.892335, 21.436772),
                            new Point(44.889036, 21.410776),
                        ]
                    )
                ]
            ),
            new Polygon(
                [
                    new LineString(
                        [
                            new Point(44.648979, 20.179532),
                            new Point(44.674314, 21.421913),
                            new Point(44.668187, 20.268635),
                        ]
                    )
                ]
            )
        ];

        return [
            'radius_numbers' => $this->faker->numberBetween(500, 1000),
            'danger' => $this->faker->randomElement(['poplava', 'zemljotres']),
            'level' => $this->faker->numberBetween(1, 5),
            'location' => $this->faker->randomElement($locations)
        ];
    }
}
