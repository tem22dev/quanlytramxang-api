<?php

namespace Database\Factories;

use App\Models\GasStation;
use Illuminate\Database\Eloquent\Factories\Factory;

class GasStationFactory extends Factory
{
    protected $model = GasStation::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
