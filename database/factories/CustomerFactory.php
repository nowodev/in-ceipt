<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::first()->id,
            'fullname' => $this->faker->name(),
            'number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address_1' => $this->faker->address(),
            'address_2' => $this->faker->address(),
        ];
    }
}