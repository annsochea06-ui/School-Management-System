@extends('layouts.app')

@section('content')
    <div class="p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <span class="typing-title text-xl font-bold text-white" data-text="CYBERTECH ACADEMY SUBJECTS"></span><span class="typing-cursor text-xl">|</span>
            <p class="text-slate-400 text-sm mt-1">Choose subject for show information and curriculum</p>
        </div>

        <!-- Subjects Grid Cards (បង្ហាញ ៤ ក្នុងមួយជួរ = ២ ជួរស្មើ ៨ Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- 1. ទាញយក Dynamic Cards ពី Database -->
            @foreach ($subjects as $subject)
                <a href="{{ route('subjects.show', $subject->id) }}"
                    class="group block p-6 bg-[#0B1120] border border-slate-800 rounded-2xl hover:border-indigo-500 transition-all shadow-lg hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-xl bg-indigo-600/20 text-indigo-400 font-bold text-xs flex items-center justify-center border border-indigo-500/20">
                            {{ $subject->code }}
                        </div>
                        <div class="text-slate-500 group-hover:text-white group-hover:translate-x-1 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-white mb-2">{{ $subject->name }}</h3>
                    <p class="text-slate-400 text-sm">View the list of students who have registered for this subject.</p>
                </a>
            @endforeach

            <!-- 2. បន្ថែម Card Static ចំនួន ៤ ទៀត (ករណី DB មានតែ ៤) -->
            @if(count($subjects) < 8)
                @php
                    $extraSubjects = [
                        ['id' => 5, 'code' => 'DES', 'name' => 'UX/UI Design'],
                        ['id' => 6, 'code' => 'DAT', 'name' => 'Data Science'],
                        ['id' => 7, 'code' => 'CLD', 'name' => 'Cloud Computing'],
                        ['id' => 8, 'code' => 'NET', 'name' => 'Network Engineering'],
                    ];
                @endphp

                @foreach ($extraSubjects as $extra)
                    <a href="{{ route('subjects.show', $extra['id']) }}"
                        class="group block p-6 bg-[#0B1120] border border-slate-800 rounded-2xl hover:border-indigo-500 transition-all shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-xl bg-indigo-600/20 text-indigo-400 font-bold text-xs flex items-center justify-center border border-indigo-500/20">
                                {{ $extra['code'] }}
                            </div>
                            <div class="text-slate-500 group-hover:text-white group-hover:translate-x-1 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-white mb-2">{{ $extra['name'] }}</h3>
                        <p class="text-slate-400 text-sm">View the list of students who have registered for this subject.</p>
                    </a>
                @endforeach
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
@endsection