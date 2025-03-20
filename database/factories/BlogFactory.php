<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::exists() ? User::where('role', 'Doctor')->inRandomOrder()->first()->id : null;
        $categoryId = Category::exists() ? Category::inRandomOrder()->first()->id : null;
            return [
                'user_id' => $userId, // Handle null fallback
                'category_id' => $categoryId, // Handle null fallback
                'title' => $this->faker->sentence,
                'description' => $this->faker->paragraph,
                'status' => $this->faker->randomElement([1, 0]),
            ];
    }
}
