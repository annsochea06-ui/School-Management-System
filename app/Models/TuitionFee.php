<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuitionFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'invoice_no',
        'total_amount',
        'amount_paid', // ត្រូវតែមាន
        'status',      // ត្រូវតែមាន
        'due_date',
    ];

    // ភ្ជាប់ទៅ Student Model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}