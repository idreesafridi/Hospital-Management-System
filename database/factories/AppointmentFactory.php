<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $patientid = User::where('role', 'Patient')->inRandomOrder()->first()?->id ?? User::factory()->create(['role' => 'Patient'])->id;
        $doctorId = User::where('role', 'Doctor')->inRandomOrder()->first()?->id ?? User::factory()->create(['role' => 'Doctor'])->id;

            return [
                'patient_id' => $patientid , 
                'doctor_id' => $doctorId, 
                'disease' => $this->faker->word,
                'appointment_date' => $this->faker->dateTimeBetween('now', '+3 months'),
                'appointment_time' => $this->faker->time('H:i:s'),
                'status' => $this->faker->randomElement(['Pending', 'Accept', 'Paid', 'Reject']),
            ];
    }
}
