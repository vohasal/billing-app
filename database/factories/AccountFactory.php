<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->numerify("Account##"),
            'amount' => fake()->randomNumber(5),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'currency_id' => Currency::query()->inRandomOrder()->first()->id
        ];
    }
}
