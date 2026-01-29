<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomNumber(5),
            'date' => fake()->date(),
            'description' => fake()->text(30),
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'account_id' => Account::query()->inRandomOrder()->first()->id
        ];
    }
}
