<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Speciality::factory(10)->create();
        \App\Models\Profile::factory(10)->create();
        \App\Models\Education::factory(10)->create();
        \App\Models\WorkExperience::factory(10)->create();
        \App\Models\DoctorAttachment::factory(10)->create();
        \App\Models\Appointment::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Blog::factory(10)->create();
        \App\Models\BlogTag::factory(10)->create();
        \App\Models\BlogAttachment::factory(10)->create();
        \App\Models\Comment::factory(10)->create();
        \App\Models\Contact::factory(10)->create();
        \App\Models\Review::factory(10)->create();
         
       
    }
}
