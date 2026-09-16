@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">STUDY SCHEDULE</h1>
            <p class="text-sm text-gray-400 mt-1">Manage and track class schedules by grade and teacher</p>
        </div>
        <a href="{{ route('timetables.create') }}" 
           class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 transition-all duration-200 shadow-lg shadow-indigo-600/30">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            + create new schedule
        </a>
    </div>

    <!-- Table Container Card -->
    <div class="bg-gray-900/60 border border-gray-800 rounded-2xl shadow-xl overflow-hidden backdrop-blur-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-800 bg-gray-800/40 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Day</th>
                        <th class="py-4 px-6">Time</th>
                        <th class="py-4 px-6">Class</th>
                        <th class="py-4 px-6">Subject</th>
                        <th class="py-4 px-6">Teacher</th>
                        <th class="py-4 px-6">Room</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/60 text-sm text-gray-300">
                    @forelse($timetables as $item)
                    <tr class="hover:bg-gray-800/30 transition-colors">
                        <td class="py-4 px-6 font-semibold text-indigo-400">{{ $item->day_of_week }}</td>
                        <td class="py-4 px-6 font-mono text-gray-300">
                            <span class="px-2.5 py-1 rounded-md bg-gray-800 text-xs border border-gray-700">
                                {{ $item->start_time }} - {{ $item->end_time }}
                            </span>
                        </td>
                        <td class="py-4 px-6 font-medium text-white">{{ $item->schoolClass->name ?? '' }}</td>
                        <td class="py-4 px-6 text-gray-300">{{ $item->subject->name ?? '' }}</td>
                        <td class="py-4 px-6 text-gray-300">
                            {{ $item->teacher->first_name ?? '' }} {{ $item->teacher->last_name ?? '' }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-md bg-purple-500/10 text-purple-400 text-xs font-medium border border-purple-500/20">
                                {{ $item->room_name }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500">No data available yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection