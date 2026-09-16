<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('student')->latest()->get();
        $students = Student::all(); // សម្រាប់ជ្រើសរើសក្នុង Modal Create

        return view('tuition_fees.index', compact('invoices', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'   => 'required|exists:students,id',
            'total_amount' => 'required|numeric',
            'amount_paid'  => 'required|numeric',
            'due_date'     => 'required|date',
            'status'       => 'required|in:PAID,PARTIAL,UNPAID',
        ]);

        Invoice::create([
            'invoice_no'   => 'INV-' . rand(100000000, 999999999),
            'student_id'   => $request->student_id,
            'total_amount' => $request->total_amount,
            'amount_paid'  => $request->amount_paid,
            'due_date'     => $request->due_date,
            'status'       => $request->status,
        ]);

        return redirect()->back()->with('success', 'បង្កើតវិក្កយបត្រជោគជ័យ!');
    }

    public function payNow($id)
{
    // ស្វែងរក Invoice តាម ID (ឬប្រើ TuitionFee បើ Model របស់អ្នកឈ្មោះ TuitionFee)
    $invoice = Invoice::findOrFail($id);

    // ធ្វើបច្ចុប្បន្នភាព Amount និង Status
    $invoice->amount_paid = $invoice->total_amount;
    $invoice->status = 'PAID';
    $invoice->save();

    return redirect()->back()->with('success', 'Pay successfully');
}
}
