<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CYBERTECH ACADEMY</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 4px 20px rgba(225, 29, 72, 0.35);
            }

            50% {
                box-shadow: 0 8px 30px rgba(225, 29, 72, 0.65);
            }
        }

        .btn-pulse {
            animation: pulseGlow 3s infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #ffffffff 0%, #fecdd3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-3d {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-3d:hover {
            transform: translateY(-8px) scale(1.02);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased overflow-x-hidden">

{{-- 2. បង្ហាញជា SweetAlert2 Popup (ប្រសិនបើចង់បាន Popup ស្អាត) --}}
@if(session('warning'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'You do not have permission to access this site!!',
            text: "{{ session('warning') }}",
            confirmButtonColor: 'darkred',
            confirmButtonText: 'okay',
        });
    </script>
@endif

    <!-- 1. Header Navigation -->
    <header class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">

                <!-- Tech Logo Icon (រចនាបែប Tech Glow & Circuit) -->
                <div
                    class="w-10 h-10 bg-rose-600 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-md shadow-rose-200 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>

                <!-- Branding Text (អក្សរ ២ ពណ៌) -->
                <div class="flex flex-col">
                    <!-- ឈ្មោះធំ ពីរពណ៌: CYBERTECH (ពណ៌ Rose) & ACADEMY (ពណ៌ Dark Slate / Blue) -->
                    <div class="flex items-center text-lg font-black tracking-wider leading-none uppercase">
                        <span class="text-rose-600">CYBERTECH</span>
                        <span class="text-slate-700 ml-1.5">ACADEMY</span>
                    </div>

                    <!-- Subtitle ខាងក្រោម -->
                    <span class="text-[10px] font-bold text-slate-400 tracking-[0.15em] uppercase mt-1">
                        SCHOOL MANAGEMENT
                    </span>
                </div>

            </a>
            <!-- Nav Links -->
            <nav class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-600">
                <a href="/" class="text-rose-600 font-bold border-b-2 border-rose-600 pb-1">Home</a>
                <a href="/about" class="hover:text-rose-600 transition-colors">About</a>
                <a href="/contact" class="hover:text-rose-600 transition-colors">Contact</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-3">
                <a href="/login"
                    class="px-5 py-2.5 text-sm font-semibold bg-slate-900 text-white rounded-full hover:bg-slate-800 transition-all shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
                <a href="/register"
                    class="btn-pulse px-5 py-2.5 text-sm font-semibold text-white bg-rose-600 rounded-full hover:bg-rose-700 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i> Register
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8 space-y-16">

        <!-- 2. Hero Banner Section (ដូចរូបភាព Home ដើមរបស់អ្នក) -->
        <section class="relative rounded-3xl overflow-hidden shadow-2xl shadow-rose-900/10 text-white"
            data-aos="fade-up">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/80 to-rose-950/60 z-10"></div>
            <img src="https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1200&auto=format&fit=crop"
                alt="Campus" class="absolute inset-0 w-full h-full object-cover">

            <div class="relative z-20 p-8 sm:p-12 lg:p-16 max-w-3xl space-y-6">
                <span
                    class="inline-flex items-center gap-2 px-4 py-1.5 bg-rose-900/60 border border-rose-500/30 rounded-full text-xs font-semibold text-rose-300 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                    CyberTech Academy - University International School of Cambodia
                </span>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
                    WELCOME TO <br>
                    <span class="gradient-text">CYBERTECH ACADEMY</span>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Welcome to CyberTech Academy, where we nurture young minds with a passion for learning and
                    innovation. Our dedicated team of educators is committed to providing a holistic education that
                    empowers students to excel academically, socially, and personally.
                </p>

                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="/login"
                        class="btn-pulse px-7 py-3.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-2xl transition-all shadow-lg shadow-rose-600/40 flex items-center gap-3">
                        <i class="fa-solid fa-users-gear"></i> Start Managing Students
                    </a>
                </div>
            </div>
        </section>

        <!-- 3. Stat Cards Section -->
        <section class="grid grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
            <div
                class="card-3d bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-100 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Students</div>
                    <div class="text-2xl font-black text-slate-900 count-up" data-target="1250">0</div>
                </div>
            </div>

            <div
                class="card-3d bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-100 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-clipboard-user"></i>
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Today's Presence</div>
                    <div class="text-2xl font-black text-slate-900 count-up" data-target="98">0</div>
                </div>
            </div>

            <div
                class="card-3d bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-100 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-school"></i>
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Classes</div>
                    <div class="text-2xl font-black text-slate-900 count-up" data-target="24">0</div>
                </div>
            </div>

            <div
                class="card-3d bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-100 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Current Date</div>
                    <div class="text-sm font-bold text-slate-900" id="current-date">August 31, 2026</div>
                </div>
            </div>
        </section>

        <!-- 4. Academic Programs Section -->
        <section data-aos="fade-up">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span
                    class="text-xs font-bold text-rose-600 uppercase tracking-wider bg-rose-50 px-3 py-1 rounded-full border border-rose-100">Academic
                    Programs</span>
                <h2 class="text-3xl font-bold text-slate-900 mt-3">Explore Our Study Programs</h2>
                <p class="text-slate-500 text-sm mt-2">កម្មវិធីសិក្សាស្របតាមស្តង់ដារអន្តរជាតិ ដើម្បីអភិវឌ្ឍសមត្ថភាពសិស្ស
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Program Card 1 -->
                <div class="card-3d bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-lg"
                    data-aos="zoom-in" data-aos-delay="100">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=600&auto=format&fit=crop"
                            class="w-full h-full object-cover">
                        <span
                            class="absolute top-4 left-4 bg-rose-600 text-white text-xs font-bold px-3 py-1 rounded-full">Primary</span>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-xl font-bold text-slate-900">Primary Education</h3>
                        <p class="text-slate-500 text-sm">បណ្តុះបណ្តាលគ្រឹះចំណេះដឹងទូទៅ ភាសា
                            និងបំណិនជីវិតជាមូលដ្ឋានសម្រាប់កុមារ។</p>
                        <a href="/register"
                            class="inline-flex items-center gap-2 text-rose-600 font-bold text-sm hover:gap-3 transition-all">Learn
                            More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Program Card 2 -->
                <div class="card-3d bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-lg"
                    data-aos="zoom-in" data-aos-delay="200">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop"
                            class="w-full h-full object-cover">
                        <span
                            class="absolute top-4 left-4 bg-slate-900 text-white text-xs font-bold px-3 py-1 rounded-full">Secondary</span>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-xl font-bold text-slate-900">Secondary Education</h3>
                        <p class="text-slate-500 text-sm">ពង្រឹងសមត្ថភាពមុខវិជ្ជាវិទ្យាសាស្ត្រ គណិតវិទ្យា
                            និងបច្ចេកវិទ្យាកម្រិតខ្ពស់។</p>
                        <a href="/register"
                            class="inline-flex items-center gap-2 text-rose-600 font-bold text-sm hover:gap-3 transition-all">Learn
                            More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Program Card 3 -->
                <div class="card-3d bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-lg"
                    data-aos="zoom-in" data-aos-delay="300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=600&auto=format&fit=crop"
                            class="w-full h-full object-cover">
                        <span
                            class="absolute top-4 left-4 bg-rose-600 text-white text-xs font-bold px-3 py-1 rounded-full">Higher
                            Ed</span>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-xl font-bold text-slate-900">Computer Science & IT</h3>
                        <p class="text-slate-500 text-sm">វគ្គសិក្សាជំនាញឯកទេស Coding, Web Development និង Data Science
                            ទំនើប។</p>
                        <a href="/register"
                            class="inline-flex items-center gap-2 text-rose-600 font-bold text-sm hover:gap-3 transition-all">Learn
                            More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Call To Action Banner -->
        <section
            class="bg-gradient-to-r from-rose-600 to-rose-700 rounded-3xl p-8 lg:p-12 text-white text-center space-y-6 shadow-xl shadow-rose-200"
            data-aos="zoom-in">
            <h2 class="text-3xl font-black">Ready to Join CyberTech Academy?</h2>
            <p class="max-w-xl mx-auto text-rose-100 text-sm">ចុះឈ្មោះឥឡូវនេះ ដើម្បីទទួលបានបទពិសោធន៍គ្រប់គ្រង
                និងរៀនសូត្របែបឌីជីថលដ៏ឆ្លាតវៃ!</p>
            <div>
                <a href="/register"
                    class="px-8 py-3.5 bg-white text-rose-600 font-bold rounded-full hover:bg-slate-100 transition-all shadow-md inline-block">
                    Register Student Now
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-8 text-center text-slate-500 text-sm">
        <p>© 2026 CYBERTECH ACADEMY. All rights reserved.</p>
    </footer>

    <!-- JS Scripts for Animations -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Counter Up Animation
        const counters = document.querySelectorAll('.count-up');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1500;
            const step = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.innerText = Math.ceil(current).toLocaleString() + (target === 98 ? '%' : '');
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = target.toLocaleString() + (target === 98 ? '%' : '');
                }
            };
            updateCounter();
        });
    </script>
    
</body>

</html>
