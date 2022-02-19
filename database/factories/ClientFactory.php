<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fio' => $this->faker->name,
            'gender' => $this->faker->randomElement(['мужской', 'женский']),
            'phone' => $this->faker->phoneNumber,
            'address' =>   $this->faker->address
        ];
    }
}
