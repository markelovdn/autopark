<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand' => $this->faker->randomElement(['Lada', 'Toyota', 'Mercedes']),
            'model' => $this->faker->randomElement(['2101', '999', '123']),
            'color' => $this->faker->colorName,
            'num' =>   $this->faker->randomElement(['Р', 'А', 'В']).$this->faker->randomElement(['192', '168', '211']).$this->faker->randomElement(['AA', 'ОК', 'ХС']).$this->faker->randomElement(['34RUS', '134RUS', '163RUS']),
            'onpark' => $this->faker->randomElement(['1', '0']),
        ];
    }
}
