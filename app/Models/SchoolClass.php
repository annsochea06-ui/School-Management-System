<?php

namespace App\Models;
// \App\Models\SchoolClass::create(['name' => 'Grade 12A', 'academic_year' => '2025-2026']);
// \App\Models\SchoolClass::create(['name' => 'Grade 12B', 'academic_year' => '2025-2026']);
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
   protected $fillable = ['class_code', 'name', 'academic_year'];

    // ថ្នាក់រៀនមួយមានសិស្សច្រើន
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}