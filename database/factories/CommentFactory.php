<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::exists() ? User::where('role', 'Patient')->inRandomOrder()->first()->id : null;
        $blogId = Blog::exists() ? Blog::inRandomOrder()->first()->id : null;
        return [
                    'user_id' => $userId,
                    'blog_id' => $blogId,
                    'name' => $this->faker->name,
                    'email' => $this->faker->unique()->safeEmail,
                    'comment' => $this->faker->paragraph,
                ];
    }
}
