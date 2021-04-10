<?php

namespace Database\Factories;

use App\Models\Transport;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'geolocation' => '',
            'type' => $types[rand(0, 2)],
            'phone_numbers' => $this->faker->phoneNumber,
            'description' => $this->faker->paragraph(4)
        ];
    }
}
