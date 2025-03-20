<?php

namespace Database\Factories;

use App\Models\Category;
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
        $parentId = Category::exists() ? Category::inRandomOrder()->first()->id : null;
        return [
                    'parent_category_id' => $parentId,
                    'name' => $this->faker->word,
                    'status' => $this->faker->randomElement([1, 0]),
                    'file' => $this->faker->imageUrl(640, 480, 'business', true, 'random', false),
                ];
    }
}
