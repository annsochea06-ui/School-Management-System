@extends('layouts.app')

@section('content')
<div class="p-8 max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 text-xs font-semibold rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                    {{ $subject->code }}
                </span>
                <h1 class="text-2xl font-bold text-white">Student List for {{ $subject->name }}</h1>
            </div>
            <p class="text-slate-400 text-sm mt-1">Data of students who have registered for this subject</p>
        </div>
        <a href="{{ route('subjects.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-300 bg-slate-800 hover:bg-slate-700 hover:text-white rounded-xl transition-all border border-slate-700 w-fit">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            ត្រឡប់ក្រោយ
        </a>
    </div>

    <!-- Data Table Container -->
    <div class="bg-[#0B1120] border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/80 text-xs uppercase text-slate-400 border-b border-slate-800">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold">ID</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Name</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Gender</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Phone Number</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Message/Notes</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Registration Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($subject->admissions as $key => $student)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-400">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-white">{{ $student->full_name }}</td>
                            <td class="px-6 py-4">
                                {{-- ប្រើ strtolower() ដើម្បីការពារករណី Database 存 'male' ឬ 'Male' --}}
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ strtolower($student->gender) == 'male' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : 'bg-pink-500/10 text-pink-400 border border-pink-500/20' }}">
                                    {{ ucfirst($student->gender) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-indigo-400 font-mono">{{ $student->phone }}</td>
                            <td class="px-6 py-4 text-slate-400 max-w-xs truncate">{{ $student->message ?? 'គ្មាន' }}</td>
                            <td class="px-6 py-4 text-slate-400 font-mono text-xs">{{ $student->created_at ? $student->created_at->format('d-M-Y') : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <span>No students have registered for this subject yet.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection