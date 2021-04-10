<?php

namespace Database\Factories;

use App\Models\Transport;
use GeoJson\Geometry\Point;
use Illuminate\Database\Eloquent\Factories\Factory;
use MStaack\LaravelPostgis\Geometries\Point;

class TransportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['helikopter', 'kombi', 'autobus'];

        return [
            'location' => $this->faker->randomElement(
                [
                    new Point([$this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)]),
                    new Point([$this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)]),
                    new Point([$this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)]),
                    new Point([$this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)]),
                    new Point([$this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)]),
                    new Point([$this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)]),
                    new Point([$this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)]),
                    new Point([$this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)]),
                ]
            ),
            'type' => $types[rand(0, 2)],
            'phone_numbers' => $this->faker->phoneNumber,
            'description' => $this->faker->paragraph(4)
        ];
    }
}
