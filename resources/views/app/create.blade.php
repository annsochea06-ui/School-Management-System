@extends('layouts.app')

@section('content')
<div class="container">
    <h2>បង្កើតវិក្កយបត្រថ្លៃសិក្សា</h2>
    <form action="{{ route('tuition-fees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>ជ្រើសរើសសិស្ស</label>
            <select name="student_id" class="form-control" required>
                <option value="">-- ជ្រើសរើសសិស្ស --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>លេខវិក្កយបត្រ (Invoice No)</label>
            <input type="text" name="invoice_no" class="form-control" value="INV-{{ time() }}" required>
        </div>
        <div class="mb-3">
            <label>តម្លៃសរុប ($)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>ចំនួនប្រាក់បានបង់ ($)</label>
            <input type="number" step="0.01" name="paid_amount" class="form-control" value="0" required>
        </div>
        <div class="mb-3">
            <label>ថ្ងៃផុតកំណត់</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">រក្សាទុក</button>
    </form>
</div>
@endsection