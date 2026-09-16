@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <!-- Page Header & Action Controls -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="typing-title text-xl font-bold text-white" data-text="CYBERTECH ACADEMY TEACHERS"></span><span
                    class="typing-cursor text-xl">|</span>
                <p class="text-xs text-slate-400 mt-1">Manage all academic staff and teacher profiles.</p>
            </div>

            <a href="{{ route('teachers.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-xs font-bold transition shadow-lg shadow-indigo-600/30">
                <i class="fa-solid fa-user-plus text-xs"></i>
                <span>Add New Teacher</span>
            </a>
        </div>

        <!-- Main Data Card Container -->
        <div
            class="bg-white dark:bg-[#0f172a] rounded-3xl border border-slate-200/80 dark:border-slate-800/80 shadow-xl overflow-hidden transition-all duration-300">

            <!-- Table Top Control Toolbar -->
            <div class="p-5 border-b border-slate-100 dark:border-slate-800/60 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Total Teachers:</span>
                    <span
                        class="px-2.5 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg text-xs font-black">
                        {{ method_exists($teachers, 'total') ? $teachers->total() : $teachers->count() }}
                    </span>
                </div>
            </div>

            <!-- Table Responsive Wrapper -->
            <div class="overflow-x-auto">
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf

                    <!-- Hidden input សម្រាប់បញ្ជូនកាលបរិច្ឆេទ Filter ទៅ Controller -->
                    <input type="hidden" name="attendance_date" value="{{ $selectedDate ?? date('Y-m-d') }}">

                    <div
                        class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-slate-800/80 bg-white dark:bg-slate-900/50 shadow-sm">
                        <table class="w-full text-left text-xs">
                            <!-- Table Header -->
                            <thead
                                class="bg-slate-50/80 dark:bg-slate-950/50 border-b border-slate-100 dark:border-slate-800/80 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                                <tr>
                                    <th class="p-4 pl-6">Profile</th>
                                    <th class="p-4">Teacher Code</th>
                                    <th class="p-4">Full Name</th>
                                    <th class="p-4">Class</th>
                                    <th class="p-4">Phone</th>
                                    <th class="p-4">Email</th>
                                    <th class="p-4">Address</th>
                                    <th class="p-4 text-center">Attendance Status</th>
                                    <th class="p-4 pr-6 text-right">Actions</th>
                                </tr>
                            </thead>

                            
                            <!-- Table Body -->
                            <tbody
                                class="divide-y divide-slate-100 dark:divide-slate-800/60 font-semibold text-slate-700 dark:text-slate-300">
                                @forelse($teachers as $teacher)
                                    @php
                                        // ទាញយក Record វត្តមានតាមថ្ងៃ Filter មក Check Radio status
                                        $attendanceRecord = $teacher->attendances->first(function ($att) use (
                                            $selectedDate,
                                        ) {
                                            return \Carbon\Carbon::parse($att->attendance_date)->format('Y-m-d') ===
                                                $selectedDate;
                                        });
                                        $currentStatus = $attendanceRecord
                                            ? strtolower($attendanceRecord->status)
                                            : 'absence';
                                    @endphp

                                    <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/30 transition-colors">
                                        <!-- Photo -->
                                        <td class="p-4 pl-6">
                                            <img src="{{ $teacher->profile_image ? asset('storage/' . $teacher->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->first_name . ' ' . $teacher->last_name) . '&background=6366f1&color=fff' }}"
                                                alt="Profile"
                                                class="w-10 h-10 rounded-2xl object-cover border border-slate-200 dark:border-slate-700 shadow-sm">
                                        </td>

                                        <!-- Teacher Code -->
                                        <td class="p-4 font-mono font-bold text-indigo-600 dark:text-indigo-400">
                                            {{ $teacher->teacher_code }}
                                        </td>

                                        <!-- Name -->
                                        <td class="p-4 font-bold text-slate-900 dark:text-white">
                                            {{ $teacher->last_name }} {{ $teacher->first_name }}
                                        </td>

                                        <!-- Class -->
                                        <td class="p-4">
                                            <span
                                                class="px-2.5 py-1 text-xs font-medium rounded-full bg-slate-800 text-slate-300">
                                                {{ $teacher->schoolClass->name ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <!-- Phone -->
                                        <td class="p-4 text-slate-500 dark:text-slate-400 font-mono">
                                            {{ $teacher->phone ?? '-' }}
                                        </td>

                                        <!-- Email -->
                                        <td class="p-4 text-slate-500 dark:text-slate-400">
                                            {{ $teacher->email ?? '-' }}
                                        </td>

                                        <!-- Address -->
                                        <td class="p-4 text-slate-500 dark:text-slate-400 max-w-xs truncate">
                                            {{ $teacher->address ?? '-' }}
                                        </td>

                                        <!-- Attendance Status Column -->
                                        <td class="p-4 text-center">
                                            <div
                                                class="inline-flex items-center gap-1.5 p-1 rounded-2xl bg-slate-100 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800">
                                                <!-- Absence -->
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="attendance[{{ $teacher->id }}]"
                                                        value="absence" class="peer hidden"
                                                        {{ $currentStatus === 'absence' || $currentStatus === 'absent' ? 'checked' : '' }}>
                                                    <span
                                                        class="flex items-center gap-1 px-3 py-1.5 rounded-xl text-[11px] font-bold text-slate-500 dark:text-slate-400 border border-transparent peer-checked:bg-rose-600 peer-checked:text-white peer-checked:border-rose-500 peer-checked:shadow-[0_0_12px_rgba(225,29,72,0.5)] transition-all duration-200">
                                                        <span
                                                            class="w-2 h-2 rounded-full border border-current bg-transparent peer-checked:bg-white inline-block"></span>
                                                        Absence
                                                    </span>
                                                </label>

                                                <!-- Join -->
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="attendance[{{ $teacher->id }}]"
                                                        value="join" class="peer hidden"
                                                        {{ $currentStatus === 'join' || $currentStatus === 'present' ? 'checked' : '' }}>
                                                    <span
                                                        class="flex items-center gap-1 px-3 py-1.5 rounded-xl text-[11px] font-bold text-slate-500 dark:text-slate-400 border border-transparent peer-checked:bg-emerald-600 peer-checked:text-white peer-checked:border-emerald-500 peer-checked:shadow-[0_0_12px_rgba(16,185,129,0.5)] transition-all duration-200">
                                                        <span
                                                            class="w-2 h-2 rounded-full border border-current bg-transparent inline-block"></span>
                                                        Join
                                                    </span>
                                                </label>

                                                <!-- Permission -->
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="attendance[{{ $teacher->id }}]"
                                                        value="permission" class="peer hidden"
                                                        {{ $currentStatus === 'permission' ? 'checked' : '' }}>
                                                    <span
                                                        class="flex items-center gap-1 px-3 py-1.5 rounded-xl text-[11px] font-bold text-slate-500 dark:text-slate-400 border border-transparent peer-checked:bg-amber-600 peer-checked:text-white peer-checked:border-amber-500 peer-checked:shadow-[0_0_12px_rgba(245,158,11,0.5)] transition-all duration-200">
                                                        <span
                                                            class="w-2 h-2 rounded-full border border-current bg-transparent inline-block"></span>
                                                        Permission
                                                    </span>
                                                </label>
                                            </div>
                                        </td>

                                        <!-- Actions -->
                                        <td class="p-4 pr-6 text-right">
                                            <div class="inline-flex items-center gap-2">
                                                <a href="{{ route('teachers.edit', $teacher->id) }}"
                                                    class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm"
                                                    title="Edit Record">
                                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="p-12 text-center text-slate-400">
                                            <div class="max-w-xs mx-auto space-y-3">
                                                <div
                                                    class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center mx-auto text-xl">
                                                    <i class="fa-solid fa-user-slash"></i>
                                                </div>
                                                <p class="font-bold text-sm text-slate-600 dark:text-slate-300">No Teachers
                                                    Found</p>
                                                <p class="text-xs text-slate-400">There are no teacher records registered in
                                                    the system yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- ផ្នែកខាងក្រោម Table ឈាងខាងស្ដាំ (Bottom-Right Action Bar) -->
                        <div
                            class="p-4 bg-slate-50/50 dark:bg-slate-950/40 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between gap-4">
                            <div class="text-xs text-slate-400 font-semibold">
                                កាលបរិច្ឆេទវត្តមាន៖ <span
                                    class="text-indigo-400">{{ $selectedDate ?? date('Y-m-d') }}</span>
                            </div>

                            <!-- Save Button -->
                            <button type="submit"
                                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-indigo-600/30 active:scale-95 cursor-pointer">
                                <i class="fa-solid fa-floppy-disk text-sm"></i> Save Attendance
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Pagination -->
            @if (method_exists($teachers, 'links'))
                <div class="p-4 border-t border-slate-100 dark:border-slate-800/60 bg-slate-50/50 dark:bg-slate-950/30">
                    {{ $teachers->links() }}
                </div>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const titleElements = document.querySelectorAll(".typing-title");

            titleElements.forEach(element => {
                const text = element.getAttribute("data-text");
                if (!text) return;

                const typingSpeed = 80;
                const deletingSpeed = 40;
                const pauseTime = 2000;

                let index = 0;
                let isDeleting = false;

                function typeEffect() {
                    if (!isDeleting && index <= text.length) {
                        element.textContent = text.substring(0, index);
                        index++;
                        setTimeout(typeEffect, typingSpeed);
                    } else if (isDeleting && index >= 0) {
                        element.textContent = text.substring(0, index);
                        index--;
                        setTimeout(typeEffect, deletingSpeed);
                    } else if (!isDeleting && index > text.length) {
                        isDeleting = true;
                        setTimeout(typeEffect, pauseTime);
                    } else if (isDeleting && index < 0) {
                        isDeleting = false;
                        index = 0;
                        setTimeout(typeEffect, 400);
                    }
                }

                typeEffect();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- បន្ថែម SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: 'រក្សាទុកជោគជ័យ!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'យល់ព្រម',
            confirmButtonColor: '#4f46e5',
            customClass: {
                popup: 'colored-border'
            }
        });
    });
</script>
@endif
@endsection
