<?php

namespace Database\Factories;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file_name' => $this->faker->image(),
            'file_path' => "/storage/test",
            'link' => $this->faker->url,
            'location' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
