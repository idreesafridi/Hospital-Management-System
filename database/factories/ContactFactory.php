<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                    'name' => $this->faker->name,
                    'email' => $this->faker->unique()->safeEmail,
                    'subject' => $this->faker->sentence,
                    'message' => $this->faker->paragraph,
                ];
    }
}
