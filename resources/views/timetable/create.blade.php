@extends('layouts.app')

@section('content')
<div style="padding: 24px; max-width: 900px; margin: 0 auto; font-family: system-ui, -apple-system, sans-serif;">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: #ffffff; margin: 0;">បន្ថែមម៉ោងរៀន (Timetable)</h1>
            <p style="font-size: 14px; color: #9ca3af; margin-top: 4px;">កំណត់កាលវិភាគសិក្សាសម្រាប់ថ្នាក់រៀន និងគ្រូបង្រៀន</p>
        </div>
        <a href="{{ route('timetables.index') }}" style="padding: 10px 18px; font-size: 14px; font-weight: 500; color: #d1d5db; background-color: #1f2937; text-decoration: none; border-radius: 10px;">
            ← ត្រឡប់ក្រោយ
        </a>
    </div>

    <!-- Form Card -->
    <div style="background-color: #111827; border: 1px solid #1f2937; border-radius: 16px; padding: 28px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);">
        <form action="{{ route('timetables.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <!-- Grid 1 -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ថ្នាក់រៀន <span style="color: #f43f5e;">*</span></label>
                    <select name="school_class_id" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                        <option value="">-- ជ្រើសរើសថ្នាក់ --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">មុខវិជ្ជា <span style="color: #f43f5e;">*</span></label>
                    <select name="subject_id" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                        <option value="">-- ជ្រើសរើសមុខវិជ្ជា --</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">គ្រូបង្រៀន <span style="color: #f43f5e;">*</span></label>
                    <select name="teacher_id" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                        <option value="">-- ជ្រើសរើសគ្រូ --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Grid 2 -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">បន្ទប់រៀន <span style="color: #f43f5e;">*</span></label>
                    <input type="text" name="room_name" placeholder="Lab 01, Room 102..." style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                </div>

                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ថ្ងៃរៀន <span style="color: #f43f5e;">*</span></label>
                    <select name="day_of_week" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>
            </div>

            <!-- Grid 3 -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ម៉ោងចាប់ផ្តើម <span style="color: #f43f5e;">*</span></label>
                    <input type="time" name="start_time" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                </div>

                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #d1d5db; margin-bottom: 8px;">ម៉ោងបញ្ចប់ <span style="color: #f43f5e;">*</span></label>
                    <input type="time" name="end_time" style="width: 100%; background-color: #1f2937; border: 1px solid #374151; color: #ffffff; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none;" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                <button type="submit" style="padding: 12px 24px; font-size: 14px; font-weight: 600; color: #ffffff; background-color: #4f46e5; border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                    រក្សាទុកកាលវិភាគ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection