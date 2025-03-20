<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogAttachment>
 */
class BlogAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $blogId = Blog::exists() ? Blog::inRandomOrder()->first()->id : null;
        return [
            'blog_id' => $blogId,  // Randomly pick an existing blog ID
            'file' => $this->faker->imageUrl(),  // Generate a random file URL
        ];
    }
}
