<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
  protected $fillable = [
        'teacher_id',
        'school_class_id',
        'attendance_date',
        'status',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}