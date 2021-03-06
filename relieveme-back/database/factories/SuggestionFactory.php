<?php

namespace Database\Factories;

use App\Models\Hazard;
use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuggestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suggestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids = Hazard::all('id')->pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'hazard_id' => $this->faker->randomElement($ids),
        ];
    }
}
