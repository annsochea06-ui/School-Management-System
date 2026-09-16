@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div>
            <span class="typing-title text-xl font-bold text-white" data-text="CYBERTECH ACADEMY CLASSES"></span><span
                    class="typing-cursor text-xl">|</span>
            <p class="text-xs text-slate-400 mt-1">Choose a class to view its details</p>
        </div>

        <!-- 8 Static Classes Grid -->
        @php
            $classList = ['A01', 'A02', 'A03', 'A04', 'A05', 'A06', 'A07', 'A08'];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
            @foreach ($classes as $code)
                <a href="{{ route('classes.show', $code) }}"
                    class="p-6 bg-white dark:bg-[#0f172a] rounded-3xl border border-slate-200/80 dark:border-slate-800/80 hover:border-indigo-500 dark:hover:border-indigo-500 shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <span
                            class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-mono font-black text-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            {{ $code }}
                        </span>
                        <i
                            class="fa-solid fa-arrow-right text-slate-300 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Class {{ $code }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Click for Manageclass</p>
                </a>
            @endforeach
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
