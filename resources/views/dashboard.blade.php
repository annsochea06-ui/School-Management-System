@extends('layouts.app')

@section('content')

{{-- <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script> --}}
<div class="p-8">
  <!-- Header Title -->
  <div class="mb-8">
    <span class="typing-title text-4xl font-bold text-white" data-text="WELCOME TO DASHBOARD"></span><span class="typing-cursor text-4xl">|</span>
    <p class="text-gray-400 text-sm mt-1">Welcome back, {{ auth()->user()->name ?? 'Alex' }}! Here is what's happening today.</p>
  </div>

  <!-- Top Stat Cards Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Total Students -->
    <div class="bg-[#121829] border border-gray-800/60 rounded-2xl p-5 flex items-center justify-between shadow-xl">
      <div>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Students</p>
        <h3 class="text-2xl font-bold text-white mt-1">1,248</h3>
        <span class="text-xs text-emerald-400 font-medium mt-1 inline-block">↑ +12% this month</span>
      </div>
      <div class="w-12 h-12 bg-indigo-600/20 text-indigo-400 border border-indigo-500/30 rounded-2xl flex items-center justify-center">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
      </div>
    </div>

    <!-- Card 2: Total Teachers -->
    <div class="bg-[#121829] border border-gray-800/60 rounded-2xl p-5 flex items-center justify-between shadow-xl">
      <div>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Teachers</p>
        <h3 class="text-2xl font-bold text-white mt-1">48</h3>
        <span class="text-xs text-gray-400 font-medium mt-1 inline-block">Active staff</span>
      </div>
      <div class="w-12 h-12 bg-purple-600/20 text-purple-400 border border-purple-500/30 rounded-2xl flex items-center justify-center">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
      </div>
    </div>

    <!-- Card 3: Active Classes -->
    <div class="bg-[#121829] border border-gray-800/60 rounded-2xl p-5 flex items-center justify-between shadow-xl">
      <div>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Active Classes</p>
        <h3 class="text-2xl font-bold text-white mt-1">32</h3>
        <span class="text-xs text-emerald-400 font-medium mt-1 inline-block">All rooms occupied</span>
      </div>
      <div class="w-12 h-12 bg-blue-600/20 text-blue-400 border border-blue-500/30 rounded-2xl flex items-center justify-center">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5"></path></svg>
      </div>
    </div>

    <!-- Card 4: Attendance Rate -->
    <div class="bg-[#121829] border border-gray-800/60 rounded-2xl p-5 flex items-center justify-between shadow-xl">
      <div>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Attendance Rate</p>
        <h3 class="text-2xl font-bold text-white mt-1">96.4%</h3>
        <span class="text-xs text-emerald-400 font-medium mt-1 inline-block">↑ +0.8% vs last week</span>
      </div>
      <div class="w-12 h-12 bg-emerald-600/20 text-emerald-400 border border-emerald-500/30 rounded-2xl flex items-center justify-center">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      </div>
    </div>
  </div>

  <!-- Middle Content: Academic Analytics & Notice Board -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Analytics Chart -->
    <div class="lg:col-span-2 bg-[#121829] border border-gray-800/60 rounded-2xl p-6 shadow-xl">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h2 class="text-lg font-bold text-white">Academic Analytics</h2>
          <p class="text-xs text-gray-400">Monthly student performance and attendance chart</p>
        </div>
        <select class="bg-[#0b0f19] border border-gray-800 text-xs text-gray-300 rounded-lg px-3 py-2 outline-none">
          <option>This Semester</option>
          <option>Last Semester</option>
        </select>
      </div>

      <!-- Chart Bars -->
      <div class="h-64 flex items-end justify-between gap-3 pt-8 px-2 border-b border-gray-800">
        <div class="w-full bg-indigo-600/20 hover:bg-indigo-600/40 rounded-t-lg transition-all h-[40%] flex items-top justify-center pt-2 text-xs text-indigo-400">Jan</div>
        <div class="w-full bg-indigo-600/20 hover:bg-indigo-600/40 rounded-t-lg transition-all h-[60%] flex items-top justify-center pt-2 text-xs text-indigo-400">Feb</div>
        <div class="w-full bg-indigo-600/20 hover:bg-indigo-600/40 rounded-t-lg transition-all h-[50%] flex items-top justify-center pt-2 text-xs text-indigo-400">Mar</div>
        <div class="w-full bg-indigo-600/20 hover:bg-indigo-600/40 rounded-t-lg transition-all h-[80%] flex items-top justify-center pt-2 text-xs text-indigo-400">Apr</div>
        <div class="w-full bg-indigo-600 rounded-t-lg transition-all h-[95%] shadow-lg shadow-indigo-600/30 flex items-top justify-center pt-2 text-xs text-white font-bold">May</div>
        <div class="w-full bg-indigo-600/20 hover:bg-indigo-600/40 rounded-t-lg transition-all h-[70%] flex items-top justify-center pt-2 text-xs text-indigo-400">Jun</div>
      </div>
    </div>

    <!-- Notice Board -->
    <div class="bg-[#121829] border border-gray-800/60 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
      <div>
        <h2 class="text-lg font-bold text-white mb-4">Notice Board</h2>
        <div class="space-y-4">
          <div class="p-3 bg-[#0b0f19] border border-gray-800/80 rounded-xl">
            <span class="text-[10px] bg-indigo-500/20 text-indigo-400 font-semibold px-2 py-0.5 rounded-md">EXAM</span>
            <h4 class="text-sm font-semibold text-gray-200 mt-1">Mid-term Examination</h4>
            <p class="text-xs text-gray-400 mt-1">Schedules are published for Computer Science department.</p>
          </div>
          <div class="p-3 bg-[#0b0f19] border border-gray-800/80 rounded-xl">
            <span class="text-[10px] bg-purple-500/20 text-purple-400 font-semibold px-2 py-0.5 rounded-md">EVENT</span>
            <h4 class="text-sm font-semibold text-gray-200 mt-1">Tech Workshop 2026</h4>
            <p class="text-xs text-gray-400 mt-1">Guest speaker presentation at Main Hall at 2:00 PM.</p>
          </div>
        </div>
      </div>
      <button class="w-full mt-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-xl text-xs transition-all shadow-lg shadow-indigo-600/30">
        View All Announcements
      </button>
    </div>

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