<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class SchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['name' => 'UX/UI Design', 'class_code' => 'DES', 'academic_year' => '2026'],
            ['name' => 'Data Science', 'class_code' => 'DAT', 'academic_year' => '2026'],
            ['name' => 'Cloud Computing', 'class_code' => 'CLD', 'academic_year' => '2026'],
            ['name' => 'Network Engineering', 'class_code' => 'NET', 'academic_year' => '2026'],
            ['name' => 'Web Development', 'class_code' => 'WEB', 'academic_year' => '2026'],
            ['name' => 'Mobile App Development', 'class_code' => 'MOB', 'academic_year' => '2026'],
            ['name' => 'Cyber Security', 'class_code' => 'SEC', 'academic_year' => '2026'],
            ['name' => 'Artificial Intelligence', 'class_code' => 'AI', 'academic_year' => '2026'],
        ];

        foreach ($classes as $class) {
            SchoolClass::updateOrCreate(['name' => $class['name']], $class);
        }
    }
}