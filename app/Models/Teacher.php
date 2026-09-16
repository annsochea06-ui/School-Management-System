<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'teacher_code',
        'profile_image',
        'first_name',
        'last_name',
        'school_class_id',
        'phone',
        'email',
        'address'
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function attendances()
    {
        // ប្រសិនបើប្រើ Table 'attendances'
        return $this->hasMany(Attendance::class, 'teacher_id', 'id');
    }
}
