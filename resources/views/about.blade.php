<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - CYBERTECH ACADEMY</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 4px 20px rgba(225, 29, 72, 0.35); }
            50% { box-shadow: 0 8px 30px rgba(225, 29, 72, 0.65); }
        }

        .btn-pulse {
            animation: pulseGlow 3s infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-3d {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-3d:hover {
            transform: translateY(-10px) scale(1.02);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased overflow-x-hidden">

    <!-- 1. Header Navigation -->
    <header class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-rose-600 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-md shadow-rose-200 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
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
                <a href="/" class="hover:text-rose-600 transition-colors">Home</a>
                <a href="/about" class="text-rose-600 font-bold border-b-2 border-rose-600 pb-1">About</a>
                <a href="/contact" class="hover:text-rose-600 transition-colors">Contact</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-3">
                <a href="/login" class="px-5 py-2.5 text-sm font-semibold text-slate-800 bg-slate-900 text-white rounded-full hover:bg-slate-800 transition-all shadow-sm">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>Login
                </a>
                <a href="/register" class="btn-pulse px-5 py-2.5 text-sm font-semibold text-white bg-rose-600 rounded-full hover:bg-rose-700 transition-all">
                    <i class="fa-solid fa-user-plus mr-2"></i>Register
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10 space-y-20">

        <!-- 2. Hero Section -->
        <section class="bg-white rounded-3xl p-8 lg:p-12 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden" data-aos="fade-up">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- Content -->
                <div class="space-y-6">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-rose-50 border border-rose-100 rounded-full text-xs font-bold text-rose-600 uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-rose-600 animate-ping"></span> About CyberTech Academy
                    </span>
                    
                    <h1 class="text-4xl lg:text-5xl font-black text-slate-900 leading-tight">
                        Transforming Education Through <span class="gradient-text">Innovation</span>
                    </h1>
                    
                    <p class="text-slate-600 leading-relaxed text-base">
                        CyberTech Academy គឺជាប្រព័ន្ធគ្រប់គ្រងសាលារៀនបែបឌីជីថលដ៏ទំនើប ដែលផ្ដល់នូវបទពិសោធន៍សិក្សា និងការគ្រប់គ្រងទិន្នន័យយ៉ាងមានប្រសិទ្ធភាព រហ័ស និងមានសុវត្ថិភាពខ្ពស់បំផុត សម្រាប់សិស្ស លោកគ្រូអ្នកគ្រូ និងអាណាព្យាបាល។
                    </p>

                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="/" class="btn-pulse px-6 py-3.5 bg-rose-600 text-white font-semibold rounded-xl hover:bg-rose-700 transition-all shadow-lg shadow-rose-200 flex items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i> Return to Homepage
                        </a>
                        <a href="#vision" class="px-6 py-3.5 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition-all flex items-center gap-2">
                            Our Mission <i class="fa-solid fa-arrow-down"></i>
                        </a>
                    </div>
                </div>

                <!-- Interactive Hero Image -->
                <div class="relative group" data-aos="zoom-in" data-aos-delay="200">
                    <div class="absolute -inset-1 bg-gradient-to-r from-rose-600 to-pink-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-500"></div>
                    <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=1000&auto=format&fit=crop" 
                             alt="Classroom" 
                             class="w-full h-[380px] object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <p class="text-sm font-medium text-rose-300">Empowering Educators & Students</p>
                            <h3 class="text-lg font-bold">Smart Digital Ecosystem</h3>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- 3. Dynamic Animated Counter Stats -->
        <section class="grid grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card-3d bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-100 text-center">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center mx-auto mb-3 text-xl">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="text-3xl font-black text-rose-600 count-up" data-target="2500">0</div>
                <div class="text-sm font-medium text-slate-500 mt-1">Total Students</div>
            </div>

            <div class="card-3d bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-100 text-center">
                <div class="w-12 h-12 bg-slate-100 text-slate-800 rounded-xl flex items-center justify-center mx-auto mb-3 text-xl">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div class="text-3xl font-black text-slate-900 count-up" data-target="120">0</div>
                <div class="text-sm font-medium text-slate-500 mt-1">Expert Teachers</div>
            </div>

            <div class="card-3d bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-100 text-center">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center mx-auto mb-3 text-xl">
                    <i class="fa-solid fa-door-open"></i>
                </div>
                <div class="text-3xl font-black text-rose-600 count-up" data-target="50">0</div>
                <div class="text-sm font-medium text-slate-500 mt-1">Academic Classes</div>
            </div>

            <div class="card-3d bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-100 text-center">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-3 text-xl">
                    <i class="fa-solid fa-face-smile"></i>
                </div>
                <div class="text-3xl font-black text-slate-900 count-up" data-target="99">0</div>
                <div class="text-sm font-medium text-slate-500 mt-1">Satisfaction %</div>
            </div>
        </section>

        <!-- 4. Interactive Vision, Mission & Values (Tabbed Section) -->
        <section id="vision" class="bg-white rounded-3xl p-8 lg:p-12 border border-slate-100 shadow-xl shadow-slate-100" data-aos="fade-up">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Our Core Foundation</h2>
                <p class="text-slate-500 mt-2">គោលការណ៍ណែនាំ និងចក្ខុវិស័យវែងឆ្ងាយរបស់ CyberTech Academy</p>
                
                <!-- Tab Buttons -->
                <div class="flex justify-center gap-2 mt-6 p-1.5 bg-slate-100 rounded-xl max-w-md mx-auto">
                    <button onclick="switchTab('vision')" id="tab-vision" class="tab-btn flex-1 py-2 px-4 rounded-lg text-sm font-bold transition-all bg-white text-rose-600 shadow-sm">
                        Vision
                    </button>
                    <button onclick="switchTab('mission')" id="tab-mission" class="tab-btn flex-1 py-2 px-4 rounded-lg text-sm font-bold transition-all text-slate-600 hover:text-slate-900">
                        Mission
                    </button>
                    <button onclick="switchTab('values')" id="tab-values" class="tab-btn flex-1 py-2 px-4 rounded-lg text-sm font-bold transition-all text-slate-600 hover:text-slate-900">
                        Values
                    </button>
                </div>
            </div>

            <!-- Tab Contents -->
            <div id="content-vision" class="tab-content text-center max-w-3xl mx-auto space-y-4 transition-all duration-300">
                <div class="w-16 h-16 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">ចក្ខុវិស័យរបស់យើង</h3>
                <p class="text-slate-600 leading-relaxed">
                    ប្រែក្លាយជាគ្រឹះស្ថានអប់រំ និងជាប្រព័ន្ធគ្រប់គ្រងឌីជីថលគំរូឈានមុខគេ ដែលតភ្ជាប់បច្ចេកវិទ្យាទំនើបជាមួយការអប់រំ ដើម្បីបង្កើតធនធានមនុស្សដែលមានសមត្ថភាពខ្ពស់សម្រាប់សង្គមជាតិ។
                </p>
            </div>

            <div id="content-mission" class="tab-content hidden text-center max-w-3xl mx-auto space-y-4 transition-all duration-300">
                <div class="w-16 h-16 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">បេសកកម្មរបស់យើង</h3>
                <p class="text-slate-600 leading-relaxed">
                    ផ្តល់នូវដំណោះស្រាយបច្ចេកវិទ្យាអប់រំដ៏ឆ្លាតវៃ និងងាយស្រួលប្រើប្រាស់ ដើម្បីជួយសម្រួលដល់ការបង្រៀន ការរៀន និងកិច្ចការរដ្ឋបាលឱ្យកាន់តែមានប្រសិទ្ធភាព និងភាពច្បាស់លាស់។
                </p>
            </div>

            <div id="content-values" class="tab-content hidden text-center max-w-3xl mx-auto space-y-4 transition-all duration-300">
                <div class="w-16 h-16 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">គុណតម្លៃស្នូល</h3>
                <p class="text-slate-600 leading-relaxed">
                    ភាពស្មោះត្រង់, ការច្នៃប្រឌិតឥតឈប់ឈរ, សុវត្ថិភាពទិន្នន័យជាចម្បង, និងការយកចិត្តទុកដាក់ខ្ពស់លើគុណភាពនៃការអប់រំ។
                </p>
            </div>
        </section>

        <!-- 5. Interactive Growth Timeline -->
        <section data-aos="fade-up">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl font-bold text-slate-900">Our Journey & Growth</h2>
                <p class="text-slate-500 mt-2">ការវិវត្តន៍ និងសមិទ្ធផលធំៗដែលយើងសម្រេចបាន</p>
            </div>

            <div class="relative border-l-2 border-rose-200 ml-4 md:ml-32 space-y-10">
                <!-- Timeline 1 -->
                <div class="relative pl-8 group" data-aos="fade-left">
                    <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-rose-600 ring-4 ring-rose-100 group-hover:scale-125 transition-transform"></div>
                    <span class="text-xs font-bold text-rose-600 bg-rose-50 px-3 py-1 rounded-full border border-rose-100">2023</span>
                    <h4 class="text-lg font-bold text-slate-900 mt-2">Established CyberTech Academy</h4>
                    <p class="text-slate-600 text-sm mt-1">ចាប់ផ្តើមបង្កើតប្រព័ន្ធគ្រប់គ្រងសាលារៀនដំបូងជាមួយសិស្សជាង ៥០០ នាក់។</p>
                </div>

                <!-- Timeline 2 -->
                <div class="relative pl-8 group" data-aos="fade-left" data-aos-delay="100">
                    <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-rose-600 ring-4 ring-rose-100 group-hover:scale-125 transition-transform"></div>
                    <span class="text-xs font-bold text-rose-600 bg-rose-50 px-3 py-1 rounded-full border border-rose-100">2024</span>
                    <h4 class="text-lg font-bold text-slate-900 mt-2">Smart Mobile App Launch</h4>
                    <p class="text-slate-600 text-sm mt-1">ដាក់ឱ្យប្រើប្រាស់ Mobile App សម្រាប់កែវត្តមាន និងពិនិត្យពិន្ទុភ្លាមៗ។</p>
                </div>

                <!-- Timeline 3 -->
                <div class="relative pl-8 group" data-aos="fade-left" data-aos-delay="200">
                    <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-rose-600 ring-4 ring-rose-100 group-hover:scale-125 transition-transform"></div>
                    <span class="text-xs font-bold text-rose-600 bg-rose-50 px-3 py-1 rounded-full border border-rose-100">2026</span>
                    <h4 class="text-lg font-bold text-slate-900 mt-2">Reached 2,500+ Active Students</h4>
                    <p class="text-slate-600 text-sm mt-1">ពង្រីកវិសាលភាពគ្រប់គ្រងដល់សិស្សជាង ២,៥០០នាក់ និងដៃគូអប់រំជាច្រើន។</p>
                </div>
            </div>
        </section>

        <!-- 6. Leadership & Team Section -->
        <section data-aos="fade-up">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl font-bold text-slate-900">Meet Our Leadership</h2>
                <p class="text-slate-500 mt-2">ថ្នាក់ដឹកនាំ និងអ្នកជំនាញដែលនៅពីក្រោយភាពជោគជ័យ</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Team Card 1 -->
                <div class="card-3d bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-lg text-center p-6" data-aos="flip-left">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&auto=format&fit=crop" 
                         alt="CEO" class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-4 border-rose-100 shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Dr. Sokha Chan</h3>
                    <p class="text-xs font-semibold text-rose-600">Founder & CEO</p>
                    <p class="text-slate-500 text-sm mt-3">បទពិសោធន៍ជាង ១៥ ឆ្នាំក្នុងវិស័យគ្រប់គ្រងអប់រំ និងបច្ចេកវិទ្យា។</p>
                </div>

                <!-- Team Card 2 -->
                <div class="card-3d bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-lg text-center p-6" data-aos="flip-left" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop" 
                         alt="CTO" class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-4 border-rose-100 shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Elena Rostova</h3>
                    <p class="text-xs font-semibold text-rose-600">Head of Technology</p>
                    <p class="text-slate-500 text-sm mt-3">អ្នកឯកទេសខាងការរចនាសុវត្ថិភាពទិន្នន័យ និងប្រព័ន្ធ Software ធំៗ។</p>
                </div>

                <!-- Team Card 3 -->
                <div class="card-3d bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-lg text-center p-6" data-aos="flip-left" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=400&auto=format&fit=crop" 
                         alt="Director" class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-4 border-rose-100 shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Vannak Leng</h3>
                    <p class="text-xs font-semibold text-rose-600">Academic Director</p>
                    <p class="text-slate-500 text-sm mt-3">សម្របសម្រួលកម្មវិធីសិក្សា និងការបណ្តុះបណ្តាលគ្រូបង្រៀន។</p>
                </div>
            </div>
        </section>

        <!-- 7. Interactive Accordion FAQ Section -->
        <section class="bg-white rounded-3xl p-8 lg:p-12 border border-slate-100 shadow-xl" data-aos="fade-up">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Frequently Asked Questions</h2>
                <p class="text-slate-500 mt-2">សំណួរដែលត្រូវបានសួរញឹកញាប់អំពីប្រព័ន្ធរបស់យើង</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="border border-slate-200 rounded-xl overflow-hidden">
                    <button onclick="toggleFaq(1)" class="w-full flex justify-between items-center p-5 text-left font-bold text-slate-900 bg-slate-50 hover:bg-slate-100 transition-colors">
                        <span>តើ CyberTech Academy សាកសមសម្រាប់សាលាកម្រិតណា?</span>
                        <i id="faq-icon-1" class="fa-solid fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <div id="faq-ans-1" class="hidden p-5 text-slate-600 border-t border-slate-200 text-sm leading-relaxed">
                        ប្រព័ន្ធរបស់យើងត្រូវបានរចនាឡើងយ៉ាងបត់បែន ដែលអាចប្រើប្រាស់បានចាប់ពីកម្រិតសាលាចំណេះទូទៅ (បឋម វិទ្យាល័យ) រហូតដល់មជ្ឈមណ្ឌលភាសា និងសាកលវិទ្យាល័យ។
                    </div>
                </div>

                <div class="border border-slate-200 rounded-xl overflow-hidden">
                    <button onclick="toggleFaq(2)" class="w-full flex justify-between items-center p-5 text-left font-bold text-slate-900 bg-slate-50 hover:bg-slate-100 transition-colors">
                        <span>តើទិន្នន័យរបស់សិស្សមានសុវត្ថិភាពកម្រិតណា?</span>
                        <i id="faq-icon-2" class="fa-solid fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <div id="faq-ans-2" class="hidden p-5 text-slate-600 border-t border-slate-200 text-sm leading-relaxed">
                        យើងប្រើប្រាស់បច្ចេកវិទ្យាសុវត្ថិភាព Cloud និង Encryption កម្រិតខ្ពស់ ការពារមិនឱ្យមានការធ្លាយទិន្នន័យ និងមានការ Backup ជាប្រចាំស្វ័យប្រវត្តិ។
                    </div>
                </div>
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
        // Init AOS Animation Library
        AOS.init({
            duration: 800,
            once: true
        });

        // Tab Switcher Logic
        function switchTab(tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-rose-600', 'shadow-sm');
                btn.classList.add('text-slate-600');
            });

            document.getElementById('content-' + tab).classList.remove('hidden');
            const activeBtn = document.getElementById('tab-' + tab);
            activeBtn.classList.add('bg-white', 'text-rose-600', 'shadow-sm');
            activeBtn.classList.remove('text-slate-600');
        }

        // FAQ Toggle Logic
        function toggleFaq(id) {
            const ans = document.getElementById('faq-ans-' + id);
            const icon = document.getElementById('faq-icon-' + id);
            ans.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Counter Up Animation Function
        const counters = document.querySelectorAll('.count-up');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1500;
            const step = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.innerText = Math.ceil(current).toLocaleString() + (target === 99 ? '%' : '+');
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = target.toLocaleString() + (target === 99 ? '%' : '+');
                }
            };
            updateCounter();
        });
    </script>
</body>
</html>