<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\Chart;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Option::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_name' => $this->faker->word,
            'age' => $this->faker->randomFloat(1, 0, 100),
            'note' => $this->faker->randomFloat(1, 0, 100),
            'chart_id' => Chart::factory(),
        ];
    }
}

