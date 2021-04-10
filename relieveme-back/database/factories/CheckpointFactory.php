<?php

namespace Database\Factories;

use App\Models\Checkpoint;
use Illuminate\Database\Eloquent\Factories\Factory;
use MStaack\LaravelPostgis\Geometries\Point;

class CheckpointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Checkpoint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
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
            'phone_numbers' => $this->faker->randomElement(
                [
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                    implode(
                        ',',
                        [
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                            $this->faker->phoneNumber,
                        ]
                    ),
                ],
            ),
            'description' => $this->faker->paragraph(2),
        ];
    }
}
