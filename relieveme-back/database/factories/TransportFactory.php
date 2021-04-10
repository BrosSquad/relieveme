<?php

namespace Database\Factories;

use App\Models\Transport;
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
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                    new Point($this->faker->randomFloat(6, 44, 45), $this->faker->randomFloat(6, 21, 22)),
                ]
            ),
            'type' => $this->faker->randomElement($types),
            'phone_numbers' => $this->faker->phoneNumber,
            'description' => $this->faker->paragraph(2)
        ];
    }
}
