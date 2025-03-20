<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speciality>
 */
class SpecialityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $parentId = Speciality::exists() ? Speciality::inRandomOrder()->first()->id : null;

    return [
        'parent_id' => $this->faker->randomElement([null, $parentId]),  // Randomly choose null or an existing ID
        'name' => $this->faker->word,
        'file' => $this->faker->imageUrl(),
        'status' => $this->faker->randomElement([1, 0]),
    ];
    }
}
