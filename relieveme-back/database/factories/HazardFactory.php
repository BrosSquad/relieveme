<?php

namespace Database\Factories;

use App\Models\Hazard;
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
        $types = ['poplava', 'zemljotres'];

        return [
            'radius_numbers' => $this->faker->numberBetween(500, 1000),
            'danger' => $types[rand(0, 1)],
            'level' => $this->faker->numberBetween(1, 5),
            'geolocation' => $this->faker->randomDigit
        ];
    }
}
