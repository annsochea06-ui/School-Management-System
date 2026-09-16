@extends('layouts.app') {{-- ឬ layouts.dashboard តាម structure របស់អ្នក --}}

@section('content')
<div class="p-6 bg-slate-950 min-h-screen text-slate-100">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <a href="javascript:history.back()" class="px-3 py-2 bg-slate-900 border border-slate-800 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition text-xs font-bold flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Comback
                </a>
                <h1 class="text-2xl font-extrabold text-white">Class {{ $className }}</h1>
            </div>
            <p class="text-xs text-slate-400">Total Students: <span class="text-indigo-400 font-bold">{{ count($students) }} នាក់</span></p>
        </div>
    </div>

    <!-- 👨‍🏫 Teacher Section (បង្ហាញ Profile + ឈ្មោះ + Contact) -->
    <div class="mb-8 p-5 bg-slate-900 border border-slate-800 rounded-2xl">
        <h2 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
            👨‍🏫 Teacher
        </h2>
        <div class="flex flex-wrap gap-4">
            @forelse($teachers as $teacher)
                <div class="flex items-center gap-3 p-3 bg-slate-950 border border-slate-800 rounded-xl min-w-[220px]">
                    <!-- Profile Image -->
                    @if(!empty($teacher->profile_image))
                        <img src="{{ asset('storage/' . $teacher->profile_image) }}" alt="Teacher Profile" class="w-10 h-10 rounded-full object-cover border border-slate-700">
                    @else
                        <div class="w-10 h-10 rounded-full bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-sm border border-indigo-500/30">
                            {{ mb_substr($teacher->first_name ?? 'T', 0, 1) }}
                        </div>
                    @endif

                    <!-- Teacher Name & Info -->
                    <div>
                        <p class="text-xs font-bold text-white">{{ $teacher->first_name }} {{ $teacher->last_name }}</p>
                        <p class="text-[11px] text-slate-400">{{ $teacher->phone ?? $teacher->email ?? 'Code: ' . ($teacher->teacher_code ?? 'N/A') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-xs text-slate-500 italic">No teacher assigned to this class yet.</p>
            @endforelse
        </div>
    </div>

    <!-- 🎓 Student List Table Section (បង្ហាញ All Data) -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="p-5 border-b border-slate-800 flex justify-between items-center">
            <h2 class="text-sm font-bold text-white flex items-center gap-2">
                🎓Student List - All Data
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-slate-950 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-800">
                    <tr>
                        <th class="px-4 py-3 text-center">ID</th>
                        <th class="px-4 py-3">Student</th>
                        <th class="px-4 py-3 text-center">Gender</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3 text-center">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($students as $index => $student)
                        <tr class="hover:bg-slate-800/50 transition">
                            <!-- # -->
                            <td class="px-4 py-3 text-center font-semibold text-slate-500">
                                {{ $index + 1 }}
                            </td>

                            <!-- Profile + Full Name -->
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if(!empty($student->profile_image))
                                        <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Student Profile" class="w-8 h-8 rounded-full object-cover border border-slate-700">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-slate-800 text-slate-300 flex items-center justify-center font-bold text-xs">
                                            {{ mb_substr($student->first_name ?? 'S', 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-bold text-white">{{ $student->first_name }} {{ $student->last_name }}</div>
                                        <div class="text-[10px] text-slate-400">ID: {{ $student->student_id ?? $student->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Gender Badge -->
                            <td class="px-4 py-3 text-center">
                                @if(strtolower($student->gender) == 'female' || $student->gender == 'ស្រី')
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        ♀ Female
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        ♂ Male
                                    </span>
                                @endif
                            </td>

                            <!-- Phone -->
                            <td class="px-4 py-3 text-slate-300 font-mono">
                                {{ $student->phone ?? '-' }}
                            </td>

                            <!-- Joined Date -->
                            <td class="px-4 py-3 text-center text-slate-400 text-[11px]">
                                {{ isset($student->created_at) ? $student->created_at->format('Y-m-d') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                No students found in this class. Please add students to see them listed here.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection