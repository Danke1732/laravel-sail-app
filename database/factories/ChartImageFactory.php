<?php

namespace Database\Factories;

use App\Models\ChartImage;
use App\Models\Chart;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChartImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChartImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_name' => $this->faker->image(),
            'image_path' => "/storage/test",
            'chart_id' => Chart::factory(),
            'location' => $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
