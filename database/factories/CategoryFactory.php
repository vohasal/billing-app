<?php

namespace Database\Factories;

use App\Enums\CategoryType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->numerify('Category##'),
            'type'  => fake()->randomElement(CategoryType::cases()),
            'user_id' => User::query()->inRandomOrder()->first()->id
        ];
    }
}
