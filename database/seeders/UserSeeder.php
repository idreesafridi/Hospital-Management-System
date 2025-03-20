<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
        {
            // Using factory to create 100 random users
            // User::factory()->count(100)->create(); 
        }
   
}
