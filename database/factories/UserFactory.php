<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phone' => $this->faker->numerify('01#########'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'gender' => $this->faker->randomElement($array  = array('male', 'female')),
            'DOB' => $this->faker->dateTimeBetween($startDate = '-60 years', $endDate = '-18 years'),
            'address' => $this->faker->streetAddress, 
            'division_id' => $this->faker->numberBetween(1,8),                      
            'city_id' => $this->faker->numberBetween(1, 20),         
            'blood_id' => $this->faker->numberBetween(1,8),
            'weight' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 150),
            'height' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 7),
            'BMI' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 18, $max = 30),
            'health_condition' => $this->faker->randomElement($array = array ('fit', 'unfit')),
            'AIDS' => 'negative',
            'malaria' => 'negative',
            'diabetes' => 'normal',
            'BP' => 'normal',
            'donate_number' => $this->faker->numberBetween(0,10),
            'avail_to_donate' =>  $this->faker->numberBetween(0,1),
            'last_donate' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
            'role_id' => 0,
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
