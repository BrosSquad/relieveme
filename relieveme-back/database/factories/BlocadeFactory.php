<?php

namespace Database\Factories;

use App\Models\Blocade;
use Illuminate\Database\Eloquent\Factories\Factory;
use MStaack\LaravelPostgis\Geometries\Point;

class BlocadeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blocade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
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
        ];
    }
}
