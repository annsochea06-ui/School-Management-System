@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">បង្កើតវិក្កយបត្រថ្មី</h1>
            <p class="text-sm text-gray-400 mt-1">បញ្ចូលព័ត៌មានបង់ថ្លៃសិក្សារបស់សិស្ស</p>
        </div>
        <a href="{{ route('tuition-fees.index') }}" class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 hover:bg-gray-700 rounded-xl transition-all">
            ← ត្រឡប់ក្រោយ
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-gray-900/60 border border-gray-800 rounded-2xl p-6 shadow-xl backdrop-blur-md">
        <form action="{{ route('tuition-fees.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">ជ្រើសរើសសិស្ស <span class="text-rose-500">*</span></label>
                <select name="student_id" class="w-full bg-gray-800/80 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 transition-colors" required>
                    <option value="">-- ជ្រើសរើសសិស្ស --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">លេខវិក្កយបត្រ (Invoice No) <span class="text-rose-500">*</span></label>
                    <input type="text" name="invoice_no" value="INV-{{ time() }}" class="w-full bg-gray-800/80 border border-gray-700 text-indigo-400 font-mono rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 transition-colors" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">ថ្ងៃផុតកំណត់ (Due Date) <span class="text-rose-500">*</span></label>
                    <input type="date" name="due_date" class="w-full bg-gray-800/80 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 transition-colors" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">តម្លៃសរុប ($) <span class="text-rose-500">*</span></label>
                    <input type="number" step="0.01" name="amount" placeholder="0.00" class="w-full bg-gray-800/80 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 transition-colors" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">ចំនួនប្រាក់បានបង់ ($) <span class="text-rose-500">*</span></label>
                    <input type="number" step="0.01" name="paid_amount" value="0" class="w-full bg-gray-800/80 border border-gray-700 text-emerald-400 font-semibold rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 transition-colors" required>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-lg shadow-indigo-600/30 transition-all">
                    រក្សាទុកវិក្កយបត្រ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection