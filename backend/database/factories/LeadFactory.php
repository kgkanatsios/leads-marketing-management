<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'consent' => $this->faker->boolean(),
            'needs_sync' => $this->faker->boolean(),
            'last_sync_time' => $this->faker->dateTimeBetween('-1 week', '-1 minute'),
        ];
    }
}
