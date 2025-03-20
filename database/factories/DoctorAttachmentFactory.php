<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\DotorAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DoctorAttachment>
 */
class DoctorAttachmentFactory extends Factory
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
                    'file' => $this->faker->imageUrl(800, 600, 'cats', true, 'random', true),
                ];
    }
}
