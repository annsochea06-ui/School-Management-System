<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ប្រើ Loop ដើម្បីបង្កើតថ្នាក់រៀនចាប់ពី A01 ដល់ A08 ដោយស្វ័យប្រវត្តិ
        for ($i = 1; $i <= 8; $i++) {
            $className = 'A' . str_pad($i, 2, '0', STR_PAD_LEFT); // នឹងបង្កើត A01, A02, ..., A08
            
            SchoolClass::create([
                'name' => $className,
                'academic_year' => '2025-2026',
            ]);
        }
    }
}