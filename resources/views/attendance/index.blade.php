@extends('layouts.app')

@section('content')
    <div class="p-6 space-y-6">

        <!-- Header & Total Count Section -->
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-calendar-check text-indigo-500"></i>
                    Daily Attendance System
                </h1>
                <p class="text-xs text-slate-400 mt-1">គ្រប់គ្រង និងស្រង់វត្តមានសិស្សប្រចាំថ្ងៃ</p>
            </div>

            <!-- Total Enrolled Badge -->
            <div
                class="px-5 py-2.5 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-bold flex items-center gap-2">
                <span>ចំនួនសិស្សសរុបក្នុងថ្នាក់៖</span>
                <span class="px-2.5 py-0.5 rounded-full bg-indigo-600 text-white font-extrabold text-sm">
                    {{ $totalTeachers }} នាក់
                </span>
            </div>
        </div>

        <!-- Filter Bar & Form -->
        <div class="p-5 rounded-3xl bg-slate-900/80 border border-slate-800 backdrop-blur-xl shadow-2xl">
            <form method="GET" action="{{ route('attendances.index') }}" class="flex flex-wrap items-end gap-4">

                <!-- Date Picker -->
                <div class="flex-1 min-w-[200px]">
                    <label
                        class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">កាលបរិច្ឆេទ</label>
                    <input type="date" name="date" value="{{ $selectedDate }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-4 py-2.5 text-xs font-semibold text-white focus:outline-none focus:border-indigo-500 transition cursor-pointer">
                </div>

                <!-- Class Select Dropdown -->
                <div class="flex-1 min-w-[200px]">
                    <label
                        class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">ជ្រើសរើសថ្នាក់</label>
                    <select name="school_class_id"
                        class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-4 py-2.5 text-xs font-semibold text-white focus:outline-none focus:border-indigo-500 transition cursor-pointer">
                        <option value="">-- គ្រប់ថ្នាក់ទាំងអស់ --</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-indigo-600/30 cursor-pointer">
                    <i class="fa-solid fa-filter"></i> Filter Records
                </button>
            </form>
        </div>

        <!-- Attendance Table -->
        <div class="rounded-3xl bg-slate-900/80 border border-slate-800 backdrop-blur-xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300 border-collapse">
                    <!-- ក្បាល Table -->
                    <thead>
                        <tr
                            class="border-b border-slate-800 text-slate-400 uppercase text-[10px] tracking-wider bg-slate-950/80">
                            <th class="p-4">គ្រូបង្រៀន (TEACHER NAME)</th>
                            <th class="p-4">អត្តលេខ</th>
                            <th class="p-4">ថ្នាក់រៀន</th>
                            <th class="p-4 text-center">អវត្តមានសរុប (TOTAL ABSENT)</th>
                            <th class="p-4 text-center">ស្ថានភាពថ្ងៃនេះ (STATUS)</th>
                        </tr>
                    </thead>

                    <!-- ដងខ្លួន Table -->
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse($teachers as $teacher)
                            @php
                                $todayAttendance = $teacher->attendances->first();
                                $status = $todayAttendance ? strtolower($todayAttendance->status) : 'not_marked';
                            @endphp

                            <tr class="hover:bg-slate-800/30 transition">
                                <!-- ឈ្មោះគ្រូ -->
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $teacher->profile_image ? asset('storage/' . $teacher->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->first_name . ' ' . $teacher->last_name) . '&background=6366f1&color=fff' }}"
                                            class="w-10 h-10 rounded-full object-cover border border-slate-700 shadow-sm"
                                            alt="Profile">
                                        <div>
                                            <div class="font-bold text-slate-200 text-sm">
                                                {{ $teacher->last_name }} {{ $teacher->first_name }}
                                            </div>
                                            <div class="text-[11px] text-slate-400">{{ $teacher->phone ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- អត្តលេខ -->
                                <td class="p-4 font-mono font-semibold text-slate-300 whitespace-nowrap">
                                    {{ $teacher->teacher_code }}
                                </td>

                                <!-- ថ្នាក់រៀន -->
                                <td class="p-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 rounded-full text-[11px] font-semibold bg-slate-800 text-slate-300 border border-slate-700">
                                        {{ $teacher->schoolClass->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <!-- អវត្តមានសរុប -->
                                <td class="p-4 text-center whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-rose-500/10 text-rose-500 border border-rose-500/20">
                                        {{ $teacher->total_absent_count ?? 0 }} លើក (អវត្តមាន:
                                        {{ $teacher->unexcused_absent_count ?? 0 }}, ច្បាប់:
                                        {{ $teacher->permission_count ?? 0 }})
                                    </span>
                                </td>

                                <!-- ស្ថានភាពថ្ងៃនេះ -->
                                <td class="p-4 text-center whitespace-nowrap">
                                    @if ($status === 'present' || $status === 'join')
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            វត្តមាន (Present)
                                        </span>
                                    @elseif($status === 'absent' || $status === 'absence')
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                            អវត្តមាន (Absent)
                                        </span>
                                    @elseif($status === 'permission')
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                            ច្បាប់ (Permission)
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-800 text-slate-400 border border-slate-700">
                                            មិនទាន់គ្រីស (Not Marked)
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-500 font-semibold">
                                    មិនមានទិន្នន័យគ្រូបង្រៀននៅក្នុងថ្នាក់នេះឡើយ!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
