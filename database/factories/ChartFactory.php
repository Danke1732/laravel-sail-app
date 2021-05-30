<?php

namespace Database\Factories;

use App\Models\Chart;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_price' => $this->faker->randomFloat(1, 0, 100),
            'purchase_fee' => $this->faker->randomFloat(1, 0, 100),
            'borrowing_amount' => $this->faker->randomFloat(1, 0, 100),
            'annual_interest' => $this->faker->randomFloat(1, 0, 100),
            'borrowing_period' => $this->faker->randomFloat(1, 0, 100),
            'monthly_rent_income' => $this->faker->randomFloat(1, 0, 100),
            'expense' => $this->faker->randomFloat(1, 0, 100),
            'vacancy' => $this->faker->randomFloat(1, 0, 100),
            'tax' => $this->faker->randomFloat(1, 0, 100),
            'ownership_period' => $this->faker->randomFloat(1, 0, 100),
            'sale_price' => $this->faker->randomFloat(1, 0, 100),
            'sale_commission' => $this->faker->randomFloat(1, 0, 100),
            // 'user_id' => 5,
            'user_id' => User::factory(),
        ];
    }
}
