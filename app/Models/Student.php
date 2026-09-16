<?php

namespace App\Models;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'school_class_id',
        'student_code',
        'profile_image',
        'first_name',
        'last_name',
        'gender',
        'phone',
        'parent_phone',
        'status',
    ];

    // ភ្ជាប់ទៅថ្នាក់រៀន

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    // សិស្សម្នាក់មានវត្តមានច្រើន
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // សិស្សម្នាក់មានពិន្ទុច្រើន
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function tuitionFees()
    {
        return $this->hasMany(TuitionFee::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
