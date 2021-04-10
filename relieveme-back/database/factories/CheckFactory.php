<?php

namespace Database\Factories;

use App\Models\Check;
use App\Models\Checkpoint;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Check::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::all('id')->pluck('id')->toArray();
        $checkpointIds = Checkpoint::all('id')->pluck('id')->toArray();

        return [
            'status' => $this->faker->randomElement([-1, 1]),
            'user_id' => $this->faker->randomElement($userIds),
            'checkpoint_id' => $this->faker->randomElement($checkpointIds)
        ];
    }
}
