@extends('layouts.app')

@section('content')
<div style="padding: 24px; max-width: 900px; margin: 0 auto; font-family: system-ui, -apple-system, sans-serif;">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: #ffffff; margin: 0;">បើកប្រាក់ខែគ្រូបង្រៀន</h1>
            <p style="font-size: 14px; color: #9ca3af; margin-top: 4px;">បញ្ចូលព័ត៌មានទូទាត់ប្រាក់ខែប្រចាំខែ</p>
        </div>
        <a href="{{ route('payrolls.index') }}" style="padding: 10px 18px; font-size: 14px; font-weight: 500; color: #d1d5db; background-color: #1f2937; text-decoration: none; border-radius: 10px;">
            ← ត្រឡប់ក្រោយ
        </a>
    </div>

    <!-- Form Card -->
    <div style="background-color: #111827; border: 1px solid #1f2937; border-radius: 16px; padding: 28px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);">
        <form action="{{ route('payrolls.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <div>
                <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ជ្រើសរើសគ្រូបង្រៀន <span style="color: #f43f5e;">*</span></label>
                <select name="teacher_id" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                    <option value="">-- ជ្រើសរើសគ្រូ --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ប្រាក់ខែគោល ($) <span style="color: #f43f5e;">*</span></label>
                    <input type="number" step="0.01" name="basic_salary" placeholder="0.00" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                </div>

                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ប្រាក់រង្វាន់ / Bonus ($)</label>
                    <input type="number" step="0.01" name="bonus" value="0.00" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #34d399; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ការកាត់ប្រាក់ / Deduction ($)</label>
                    <input type="number" step="0.01" name="deduction" value="0.00" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #f87171; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;">
                </div>

                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ប្រចាំខែ/ឆ្នាំ <span style="color: #f43f5e;">*</span></label>
                    <input type="text" name="month_year" placeholder="ឧ. 08-2026" value="{{ date('m-Y') }}" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                <button type="submit" style="padding: 12px 24px; font-size: 14px; font-weight: 600; color: #ffffff; background-color: #4f46e5; border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                    រក្សាទុក
                </button>
            </div>
        </form>
    </div>
</div>
@endsection