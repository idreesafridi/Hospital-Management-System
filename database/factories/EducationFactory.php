<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doctorId = User::where('role', 'Doctor')->inRandomOrder()->first()?->id ?? User::factory()->create(['role' => 'Doctor'])->id;

    return [
        'doctor_id' => $doctorId,  // Assign a doctor ID, either existing or newly created
        'university' => $this->faker->company,
        'degree' => $this->faker->word,
        'start_date' => $this->faker->dateTimeBetween('-10 years', '-5 years'),
        'end_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
    ];
}

}
