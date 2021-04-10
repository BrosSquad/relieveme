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
        return [
            'danger' => $this->faker->randomElement(['poplava', 'zemljotres']),
            'level' => $this->faker->numberBetween(1, 5),
            'radius' => random_int(500, 50_000),
            'location' => $this->faker->randomElement(
                [
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                ]
            )
        ];
    }
}
