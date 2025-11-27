<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'password' => Hash::make('admin123'),
            'role_id' => \App\Models\Role::inRandomOrder()->first()->id,
        ];
    }
}
