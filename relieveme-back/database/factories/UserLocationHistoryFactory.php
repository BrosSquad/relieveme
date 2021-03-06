<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserLocationHistory;
use Illuminate\Database\Eloquent\Factories\Factory;
use MStaack\LaravelPostgis\Geometries\Point;

class UserLocationHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserLocationHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $ids = User::all('id')->pluck('id');

        return [
            'user_id' => $this->faker->randomElement($ids->toArray()),
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
