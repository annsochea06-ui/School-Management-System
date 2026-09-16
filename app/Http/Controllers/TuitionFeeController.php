<?php

namespace App\Http\Controllers;

use App\Models\TuitionFee;
use App\Models\Student;
use Illuminate\Http\Request;

class TuitionFeeController extends Controller
{
    public function index()
    {
        $tuitionFees = TuitionFee::with('student')->latest()->get();
        return view('tuition_fees.index', compact('tuitionFees'));
    }

    public function create()
    {
        $students = Student::all();
        return view('tuition_fees.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'amount'      => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_date'    => 'required|date',
            'invoice_no'  => 'required|unique:tuition_fees,invoice_no',
        ]);

        $validated['status'] = $request->paid_amount >= $request->amount ? 'paid' : ($request->paid_amount > 0 ? 'partial' : 'unpaid');

        TuitionFee::create($validated);

        return redirect()->route('tuition-fees.index')->with('success', 'បង្កើតវិក្កយបត្របានជោគជ័យ!');
    }

 public function payNow($id)
{
    // ស្វែងរក Invoice តាម ID
    $invoice = TuitionFee::findOrFail($id); 

    // ប្តូរតម្លៃដោយផ្ទាល់
    $invoice->amount_paid = $invoice->total_amount;
    $invoice->status = 'PAID'; // ប្រសិនបើក្នុង Database ប្រើអក្សរតូច សូមដូរទៅ 'paid'
    
    // រក្សាទុកចូល Database
    $invoice->save();

    return redirect()->back()->with('success', 'ទូទាត់ប្រាក់ជោគជ័យ!');
}
}
