<?php

namespace Database\Factories;

use App\Models\Fuel;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuelFactory extends Factory
{
    protected $model = Fuel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(10000, 100000),
            'description' => $this->faker->sentence,
            'type_fuel' => 'diesel', // hoặc bất kỳ giá trị nào phù hợp
        ];
    }
}
