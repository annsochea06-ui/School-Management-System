<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: true, sidebarOpen: false }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise School Management System</title>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body
    class="bg-slate-50 text-slate-800 dark:bg-[#080d1a] dark:text-slate-100 transition-colors duration-300 antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-slate-950/80 z-30 backdrop-blur-md lg:hidden" x-transition></div>

        <!-- SIDEBAR NAVIGATION -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-[#0f172a] border-r border-slate-200 dark:border-slate-800/80 transition-transform duration-300 lg:static lg:translate-x-0 flex flex-col justify-between shadow-2xl">

            <div>
                <!-- Brand Logo -->
                <div
                    class="h-20 flex items-center justify-between px-6 border-b border-slate-100 dark:border-slate-800/60">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white text-lg shadow-lg shadow-indigo-500/30">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div>
                            <span class="text-base font-black tracking-wide text-slate-900 dark:text-white">NIB
                                ACADEMY</span>
                            <span
                                class="block text-[10px] text-indigo-500 font-extrabold tracking-widest uppercase">University</span>
                        </div>
                    </div>
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>

                <!-- MAIN MENU ROUTES -->
                <nav class="p-4 space-y-1.5 text-xs font-semibold">
                    <div
                        class="px-3 pb-2 text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider">
                        MAIN MENU</div>


                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <!-- ប្រើ fa-chart-pie ឬ fa-gauge-high សម្រាប់ Dashboard -->
                        <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('students.index') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('students.*') ? 'bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-user-graduate w-5 text-center text-base"></i>
                        <span>Students</span>
                    </a>

                    <a href="{{ route('teachers.index') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('teachers.*') ? 'bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-chalkboard-user w-5 text-center text-base"></i>
                        <span>Teachers</span>
                    </a>

                    <a href="{{ route('classes.index') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('classes.*') ? 'bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-school w-5 text-center text-base"></i>
                        <span>Classes</span>
                    </a>

                    <a href="{{ route('attendance.index') }}"
                        class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('attendance.*') ? 'bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <i class="fa-solid fa-calendar-check w-5 text-center text-base"></i>
                        <span>Attendance</span>
                    </a>

                    @php
    $currentRoute = Route::currentRouteName();
@endphp

    <!-- 1. Subjects Page -->
    <a href="{{ route('subjects.index') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 
       {{ str_starts_with($currentRoute, 'subjects') 
          ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' 
          : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <i class="fa-solid fa-book-bookmark text-sm w-5 text-center transition-colors
           {{ str_starts_with($currentRoute, 'subjects') ? 'text-white' : 'text-slate-400' }}"></i>
        <span>Subjects</span>
    </a>

    <!-- 2. Tuition Fees Page -->
    <a href="{{ route('tuition-fees.index') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 
       {{ str_starts_with($currentRoute, 'tuition-fees') || str_starts_with($currentRoute, 'invoices') 
          ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' 
          : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <i class="fa-solid fa-file-invoice-dollar text-sm w-5 text-center transition-colors
           {{ str_starts_with($currentRoute, 'tuition-fees') || str_starts_with($currentRoute, 'invoices') ? 'text-white' : 'text-slate-400' }}"></i>
        <span>Tuition Fees</span>
    </a>

    <!-- 3. Payrolls Page -->
    <a href="{{ route('payrolls.index') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 
       {{ str_starts_with($currentRoute, 'payrolls') 
          ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' 
          : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <i class="fa-solid fa-wallet text-sm w-5 text-center transition-colors
           {{ str_starts_with($currentRoute, 'payrolls') ? 'text-white' : 'text-slate-400' }}"></i>
        <span>Payrolls</span>
    </a>

    <!-- 4. Timetables Page -->
    <a href="{{ route('timetables.index') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 
       {{ str_starts_with($currentRoute, 'timetables') 
          ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' 
          : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <i class="fa-solid fa-calendar-days text-sm w-5 text-center transition-colors
           {{ str_starts_with($currentRoute, 'timetables') ? 'text-white' : 'text-slate-400' }}"></i>
        <span>Timetables</span>
    </a>

                </nav>
            </div>

            <!-- Profile Info Footer -->
            <!-- Container ប្រើ Alpine.js x-data សម្រាប់ បិទ/បើក Dropdown -->
            <div class="relative" x-data="{ open: false }">

                <!-- Profile Card Button (ចុចដើម្បី បើក/បិទ Menu) -->
                <button @click="open = !open" @click.away="open = false"
                    class="w-full flex items-center gap-3 p-3 bg-slate-900/80 hover:bg-slate-800 rounded-2xl border border-slate-800 transition-all cursor-pointer text-left focus:outline-none">

                    <!-- Icon / Avatar -->
                    <div
                        class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-indigo-600/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>

                    <!-- Name & Role -->
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-bold text-white truncate">Admin</h4>
                        <p class="text-xs text-slate-400 truncate">Super Admin</p>
                    </div>

                    <!-- Arrow Icon -->
                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200"
                        :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu Box -->
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute bottom-full left-0 mb-2 w-full bg-slate-900 border border-slate-800 rounded-2xl shadow-xl p-2 z-50 space-y-1"
                    style="display: none;">

                    <!-- Profile Link -->
                    <a href="#"
                        class="flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-slate-300 hover:text-white hover:bg-slate-800 rounded-xl transition-all">
                        <span>👤</span>
                        <span>My Profile</span>
                    </a>

                    <!-- Settings Link -->
                    <a href="#"
                        class="flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-slate-300 hover:text-white hover:bg-slate-800 rounded-xl transition-all">
                        <span>⚙️</span>
                        <span>Account Settings</span>
                    </a>

                    <div class="border-t border-slate-800 my-1"></div>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 rounded-xl transition-all text-left">
                            <span>🚪</span>
                            <span>Log Out</span>
                        </button>
                    </form>
                </div>

            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col overflow-y-auto">

            <!-- Top Header -->
            <header
                class="h-20 bg-white/80 dark:bg-[#0f172a]/80 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800/80 flex items-center justify-between px-6 sticky top-0 z-20">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true"
                        class="lg:hidden text-slate-500 p-2 rounded-xl border border-slate-200 dark:border-slate-800">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="relative hidden sm:block w-64 md:w-80">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
                        <input type="text" placeholder="Search system records..."
                            class="w-full pl-9 pr-4 py-2.5 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs text-slate-800 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:border-indigo-500 transition">
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button @click="darkMode = !darkMode"
                        class="p-2.5 bg-slate-100 dark:bg-slate-950 text-slate-600 dark:text-amber-400 rounded-2xl border border-slate-200 dark:border-slate-800 transition">
                        <i class="fa-solid" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
                    </button>
                </div>
            </header>

            <!-- Dynamic Body Content -->
            <main class="p-6 md:p-8 space-y-8">
                @hasSection('content')
                    @yield('content')
                @else
                    <div>
                        <!-- Title & Quick Actions Header -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                            <div>
                                <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">System
                                    Analytics & Overview</h1>
                                <p class="text-xs text-slate-400 mt-1">Real-time management dashboard and quick
                                    controls.</p>
                            </div>

                            <!-- FEATURE 1: Quick Actions Toolbar -->
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ route('students.create') }}"
                                    class="px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-indigo-600/20">
                                    <i class="fa-solid fa-plus"></i> Add Student
                                </a>
                                <a href="{{ route('teachers.create') }}"
                                    class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-emerald-600/20">
                                    <i class="fa-solid fa-plus"></i> Add Teacher
                                </a>
                                <a href="{{ route('attendance.index') }}"
                                    class="px-3.5 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-2">
                                    <i class="fa-solid fa-clipboard-user"></i> Attendance
                                </a>
                            </div>
                        </div>

                        <!-- STAT CARDS GRID -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <div
                                class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 flex justify-between items-start">
                                <div>
                                    <p class="text-slate-400 text-xs font-bold uppercase">Total Students</p>
                                    <h3 class="text-3xl font-black text-slate-900 dark:text-white mt-2">1,500</h3>
                                    <span class="text-[10px] text-emerald-500 font-bold"><i
                                            class="fa-solid fa-arrow-up"></i> +5.4% this month</span>
                                </div>
                                <div
                                    class="w-12 h-12 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center text-xl">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 flex justify-between items-start">
                                <div>
                                    <p class="text-slate-400 text-xs font-bold uppercase">Total Teachers</p>
                                    <h3 class="text-3xl font-black text-slate-900 dark:text-white mt-2">80</h3>
                                    <span class="text-[10px] text-slate-400 font-bold">12 Academic Depts</span>
                                </div>
                                <div
                                    class="w-12 h-12 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center text-xl">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 flex justify-between items-start">
                                <div>
                                    <p class="text-slate-400 text-xs font-bold uppercase">Active Classes</p>
                                    <h3 class="text-3xl font-black text-slate-900 dark:text-white mt-2">40</h3>
                                    <span class="text-[10px] text-indigo-400 font-bold">Full capacity</span>
                                </div>
                                <div
                                    class="w-12 h-12 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center text-xl">
                                    <i class="fa-solid fa-school"></i>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 flex justify-between items-start">
                                <div>
                                    <p class="text-slate-400 text-xs font-bold uppercase">Avg Attendance</p>
                                    <h3 class="text-3xl font-black text-slate-900 dark:text-white mt-2">96.8%</h3>
                                    <span class="text-[10px] text-emerald-500 font-bold"><i
                                            class="fa-solid fa-check"></i> Normal Range</span>
                                </div>
                                <div
                                    class="w-12 h-12 bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 rounded-2xl flex items-center justify-center text-xl">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                            </div>
                        </div>

                        <!-- FEATURE 2 & 3: Recent Activities & Upcoming Events Layout -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                            <!-- FEATURE 2: Recent Activity Logs (2 Columns) -->
                            <div
                                class="lg:col-span-2 bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800">
                                <div class="flex items-center justify-between mb-6">
                                    <h3
                                        class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                        <i class="fa-solid fa-clock-rotate-left text-indigo-500"></i> Recent System
                                        Activities
                                    </h3>
                                    <span class="text-[11px] text-slate-400">Live Updates</span>
                                </div>

                                <div class="space-y-4">
                                    <div
                                        class="flex items-start gap-4 p-3 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-100 dark:border-slate-800/50">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center text-xs mt-0.5">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">New Student
                                                Registered</p>
                                            <p class="text-[11px] text-slate-400">John Doe enrolled into Class 12-A</p>
                                        </div>
                                        <span class="text-[10px] font-semibold text-slate-400">10 mins ago</span>
                                    </div>

                                    <div
                                        class="flex items-start gap-4 p-3 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-100 dark:border-slate-800/50">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-xs mt-0.5">
                                            <i class="fa-solid fa-file-circle-check"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Exam Scores
                                                Updated</p>
                                            <p class="text-[11px] text-slate-400">Mid-term Mathematics scores entered
                                                by Prof. Smith</p>
                                        </div>
                                        <span class="text-[10px] font-semibold text-slate-400">1 hour ago</span>
                                    </div>

                                    <div
                                        class="flex items-start gap-4 p-3 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-100 dark:border-slate-800/50">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-xs mt-0.5">
                                            <i class="fa-solid fa-calendar-minus"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Attendance
                                                Logged</p>
                                            <p class="text-[11px] text-slate-400">Daily attendance submitted for Grade
                                                10-B</p>
                                        </div>
                                        <span class="text-[10px] font-semibold text-slate-400">3 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <!-- FEATURE 3: Upcoming Academic Events (1 Column) -->
                            <div
                                class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800">
                                <h3
                                    class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                    <i class="fa-solid fa-calendar-days text-amber-500"></i> Upcoming Schedule
                                </h3>

                                <div class="space-y-4">
                                    <div class="p-3.5 rounded-2xl border border-slate-200 dark:border-slate-800">
                                        <span
                                            class="text-[10px] font-extrabold text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded-md uppercase">Next
                                            Week</span>
                                        <h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-2">Final
                                            Semester Exams</h4>
                                        <p class="text-[11px] text-slate-400 mt-0.5"><i
                                                class="fa-regular fa-clock"></i> Aug 25 - Aug 30, 2026</p>
                                    </div>

                                    <div class="p-3.5 rounded-2xl border border-slate-200 dark:border-slate-800">
                                        <span
                                            class="text-[10px] font-extrabold text-indigo-500 bg-indigo-500/10 px-2 py-0.5 rounded-md uppercase">Faculty
                                            Meeting</span>
                                        <h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-2">Teachers
                                            Briefing Session</h4>
                                        <p class="text-[11px] text-slate-400 mt-0.5"><i
                                                class="fa-regular fa-clock"></i> Sep 02, 2026 - 09:00 AM</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif
            </main>
        </div>
    </div>

</body>

</html>
