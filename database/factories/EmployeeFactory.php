<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Religion;
use App\Models\Country;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar' => $this->faker->name(),
            'name_en' => $this->faker->name(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->numerify('az%d@az.com', 1, 5),
            'password' => Hash::make('123456789'), // You can change the default password here
            'is_active' => '1',
            'role_id' => 1, // Adjust the range based on your roles
            'type' => $this->faker->numberBetween(0, 1), // Adjust the range if you have more types
            'national_id' => $this->faker->unique()->randomNumber(9, true), // Generate a unique 9-digit number
            'birth_date' => $this->faker->date(),
            'work_date' => $this->faker->date(),
            'address1' => $this->faker->address(),
            'address2' => $this->faker->secondaryAddress(),
            'address3' => $this->faker->city(),
            'phone2' => $this->faker->phoneNumber(),
            'phone3' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement([0, 1]), 
            'method_for_payment' => $this->faker->randomElement([0, 1]),
            'acc_bank_no' => $this->faker->bankAccountNumber(),
            'token' => Str::random(10), 
        ];
    }
}
