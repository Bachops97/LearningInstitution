<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'name' => 'Introduction to Programming',
            'description' => 'A beginner-level programming course',
            'steps' => 10,
        ]);

        Course::create([
            'name' => 'Web Development Fundamentals',
            'description' => 'A basic web development course',
            'steps' => 8,
        ]);
    }
}
