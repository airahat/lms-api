<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('course_status')->insert([
            [
                'name' => 'Draft',
                'slug' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Published',
                'slug' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Archived',
                'slug' => 'archived',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
