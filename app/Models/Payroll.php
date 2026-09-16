<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'basic_salary',
        'bonus',
        'deduction',
        'net_salary',
        'month_year',
        'status',
        'payment_date',
    ];

    // ភ្ជាប់ទៅ Teacher Model
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}