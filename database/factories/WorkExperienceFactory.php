<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\WorkExperience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkExperience>
 */
class WorkExperienceFactory extends Factory
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
            'doctor_id' => $doctorId,  
            'hospital' => $this->faker->company,  
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),  
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'), 
        ];

    }
}
