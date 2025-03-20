<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogTag>
 */
class BlogTagFactory extends Factory
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
            'blog_id' => $blogId , 
            'name' => $this->faker->sentence,  
        ];;
    }
}
