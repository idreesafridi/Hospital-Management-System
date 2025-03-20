<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doctorId = User::exists() ? User::where('role', 'Doctor')->inRandomOrder()->first()->id : null;
        $patientId = User::exists() ? User::where('role', 'Patient')->inRandomOrder()->first()->id : null;
        return [
                    'title' => $this->faker->sentence,
                    'review' => $this->faker->paragraph,
                    'doctor_id' => $doctorId,
                    'user_id' => $patientId,
                    'rating' => $this->faker->numberBetween(1, 5),
                    'term' => $this->faker->word,
                    'status' => $this->faker->randomElement([1, 0]),
                ];
    }
}
