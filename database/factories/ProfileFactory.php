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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     protected $model = Profile::class;
    public function definition(): array
    {
         //profiledata
         $userId = User::exists() ? User::inRandomOrder()->first()->id : null;
         $specialityId = Speciality::exists() ? Speciality::inRandomOrder()->first()->id : null;
     
         return [
             'user_id' => $userId,  // Randomly pick an existing User ID or null
             'speciality_id' => $specialityId,  // Randomly pick an existing Speciality ID or null
             'profile_image' => $this->faker->imageUrl(),
             'address' => $this->faker->address,
             'phone_number' => $this->faker->phoneNumber,
             'about' => $this->faker->paragraph,
         ];
    }
}
