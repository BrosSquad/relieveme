<?php

namespace Database\Factories;

use App\Models\Check;
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
        $status = [-1, 1];

        return [
            'status' => $status[rand(0, 1)],
            'user_id' => rand(1, 10),
            'checkpoint_id' => rand(1, 10)
        ];
    }
}
