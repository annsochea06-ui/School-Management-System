<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        // ទាញយក Payrolls ភ្ជាប់ជាមួយព័ត៌មានគ្រូ (រួមទាំងកុងធនាគារ)
        $payrolls = Payroll::with('teacher')->latest()->get();
        $teachers = Teacher::all(); // សម្រាប់ប្រើប្រាស់ក្នុង Modal Create New Payroll

        return view('payrolls.index', compact('payrolls', 'teachers'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('payrolls.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id'   => 'required|exists:teachers,id',
            'basic_salary' => 'required|numeric|min:0',
            'bonus'        => 'nullable|numeric|min:0',
            'deduction'    => 'nullable|numeric|min:0',
            'month_year'   => 'required|string',
        ]);

        $basicSalary = (float) $request->basic_salary;
        $bonus       = (float) ($request->bonus ?? 0);
        $deduction   = (float) ($request->deduction ?? 0);
        $netSalary   = $basicSalary + $bonus - $deduction;

        Payroll::create([
            'teacher_id'   => $request->teacher_id,
            'basic_salary' => $basicSalary,
            'bonus'        => $bonus,
            'deduction'    => $deduction,
            'net_salary'   => $netSalary,
            'month_year'   => $request->month_year,
            'status'       => 'unpaid', // <-- កែសម្រួលមកប្រើអក្សរតូច 'unpaid' ត្រង់នេះ
        ]);

        return redirect()->route('payrolls.index')->with('success', 'បង្កើតកំណត់ត្រាប្រាក់ខែជោគជ័យ!');
    }

    public function pay(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'nullable|string|max:255',
            'note'           => 'nullable|string|max:255',
        ]);

        $payroll = Payroll::findOrFail($id);

        // ធ្វើបច្ចុប្បន្នភាព Status ទៅជា PAID និងកត់ត្រាថ្ងៃបង់
        $payroll->update([
            'status'         => 'PAID',
            'payment_method' => $request->payment_method ?? 'Bank Transfer',
            'note'           => $request->note,
            'payment_date'   => now(),
        ]);

        return redirect()->back()->with('success', 'ការបង់ប្រាក់បៀវត្សរ៍ទទួលបានជោគជ័យ!');
    }
}
