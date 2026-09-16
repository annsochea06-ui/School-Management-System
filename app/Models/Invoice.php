<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'student_id',
        'total_amount',
        'amount_paid',
        'due_date',
        'status',
    ];

    // Relationship ភ្ជាប់ទៅ Student Model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function payNow($id)
    {
        // ស្វែងរក Invoice តាម ID
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return redirect()->back()->with('error', 'រកមិនឃើញ Invoice នេះទេ!');
        }

        // Update ទិន្នន័យ
        $invoice->amount_paid = $invoice->total_amount;
        $invoice->status = 'PAID';
        $invoice->save();

        return redirect()->back()->with('success', 'Pay successfully');
    }
}
