<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - CYBERTECH ACADEMY</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SweetAlert2 for Notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .faq-answer.open {
            max-height: 200px;
        }
    </style>
</head>

<body
    class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex flex-col justify-between overflow-x-hidden">

    <!-- 1. Header Navigation -->
    <header class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div
                    class="w-10 h-10 bg-rose-600 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-md shadow-rose-200 group-hover:scale-105 transition-transform">
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

            <nav class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-600">
                <a href="/" class="hover:text-rose-600 transition-colors">Home</a>
                <a href="/about" class="hover:text-rose-600 transition-colors">About</a>
                <a href="/contact" class="text-rose-600 font-bold border-b-2 border-rose-600 pb-1">Contact</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="/login"
                    class="px-5 py-2.5 text-sm font-semibold bg-slate-900 text-white rounded-full hover:bg-slate-800 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
                <a href="/register"
                    class="btn-pulse px-5 py-2.5 text-sm font-semibold text-white bg-rose-600 rounded-full hover:bg-rose-700 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i> Register
                </a>
            </div>
        </div>
    </header>

    <!-- 2. Main Contact Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-10 my-auto w-full space-y-12">

        <!-- Main Form & Info Grid -->
        <div class="bg-white rounded-3xl shadow-2xl shadow-slate-300/60 overflow-hidden border border-slate-100 grid lg:grid-cols-12"
            data-aos="fade-up">

            <!-- Left Side: Dynamic Branch Selection & Info -->
            <div
                class="lg:col-span-5 bg-slate-900 text-white p-8 lg:p-10 flex flex-col justify-between space-y-6 relative overflow-hidden">
                <div class="space-y-6 relative z-10">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-black flex items-center gap-2">🏫 School Address</h2>
                        <!-- FEATURE: Instant Chat Button -->
                        <a href="https://t.me/" target="_blank"
                            class="px-3 py-1 bg-sky-500/20 text-sky-400 border border-sky-500/30 rounded-full text-xs font-semibold hover:bg-sky-500 hover:text-white transition-all flex items-center gap-1.5">
                            <i class="fa-brands fa-telegram"></i> Live Chat
                        </a>
                    </div>

                    <!-- FEATURE: Multi-Branch Tab Switcher -->
                    <div class="flex bg-slate-800 p-1 rounded-xl gap-1 text-xs font-semibold">
                        <button onclick="switchBranch('phnompenh')" id="btn-phnompenh"
                            class="branch-btn flex-1 py-2 rounded-lg bg-rose-600 text-white transition-all">Phnom
                            Penh</button>
                        <button onclick="switchBranch('siemreap')" id="btn-siemreap"
                            class="branch-btn flex-1 py-2 rounded-lg text-slate-400 hover:text-white transition-all">Siem
                            Reap</button>
                    </div>

                    <!-- Branch Information Container -->
                    <div id="branch-info" class="space-y-4 text-sm">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700/60 text-rose-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-200">Address</h4>
                                <p id="info-address" class="text-slate-400 text-xs leading-relaxed mt-0.5">Building 123,
                                    Street 2004, Sangkat Kakap, Khan Por Sen Chey, Phnom Penh</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700/60 text-rose-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-200">Email</h4>
                                <p id="info-email" class="text-slate-400 text-xs leading-relaxed mt-0.5">
                                    info@cybertech.edu.kh</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700/60 text-rose-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-200">Phone number</h4>
                                <p id="info-phone" class="text-slate-400 text-xs leading-relaxed mt-0.5">+855 12 345 678
                                    / +855 98 765 432</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FEATURE: Dynamic Google Map Embed -->
                <div class="relative z-10 rounded-2xl overflow-hidden border border-slate-700 shadow-md">
                    <iframe id="map-iframe"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.773981882046!2d104.8722!3d11.5685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109519fe40f252d%3A0xb35a9094038a3915!2sPhnom%20Penh!5e0!3m2!1sen!2skh!4v1700000000000!5m2!1sen!2skh"
                        class="w-full h-40 border-0 filter grayscale hover:grayscale-0 transition-all duration-500"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- Right Side: Interactive Admission Form -->
            <div class="lg:col-span-7 p-8 lg:p-12 flex flex-col justify-center">
                <div class="mb-6">
                    <h2 class="text-2xl font-black text-slate-900 flex items-center gap-2">📝 Admission Form</h2>
                    <p class="text-slate-500 text-xs mt-1">Please fill out the information below so that our team can
                        contact you.</p>
                </div>

                <form action="{{ route('admissions.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Flash Message ពេល Submit ជោគជ័យ -->
                    <!-- Success Modal Pop-up (គ្មាន Background Blur) -->
                    @if (session('success'))
                        <!-- Outer Container (លាក់ Background Blur ទាំងស្រុង) -->
                        <div id="successModal"
                            class="fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none">

                            <!-- ប្រអប់ Modal រាងការ៉េ (មាន Pop-up Animation ស្អាត) -->
                            <div id="modalContent"
                                class="relative w-80 h-80 bg-white rounded-3xl shadow-2xl p-6 flex flex-col items-center justify-between text-center border border-slate-100 pointer-events-auto transform scale-50 opacity-0 transition-all duration-300 cubic-bezier(0.34, 1.56, 0.64, 1)">

                                <!-- ប៊ូតុង X បិទ -->
                                <button onclick="closeModal()"
                                    class="absolute top-4 right-4 text-slate-400 hover:text-rose-500 transition-colors">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>

                                <!-- Icon Success (មានចលនា Pulse ស្រទន់) -->
                                <div class="mt-2">
                                    <div
                                        class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto shadow-inner animate-pulse">
                                        <i class="fa-solid fa-circle-check text-3xl"></i>
                                    </div>
                                </div>

                                <!-- សារជូនដំណឹង -->
                                <div class="my-auto">
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">
                                        ចុះឈ្មោះជោគជ័យ!
                                    </h3>
                                    <p class="text-xs font-medium text-slate-500 leading-relaxed px-2">
                                        {{ session('success') }}
                                    </p>
                                </div>

                                <!-- ប៊ូតុង យល់ព្រម -->
                                <button onclick="closeModal()"
                                    class="w-full py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl shadow-lg shadow-rose-600/30 transition-all duration-200 transform hover:scale-[1.02] active:scale-95 cursor-pointer">
                                    យល់ព្រម
                                </button>

                            </div>
                        </div>

                        <!-- Script សម្រាប់ Pop-up Animation -->
                        <script>
                            function showModal() {
                                const content = document.getElementById('modalContent');
                                if (content) {
                                    setTimeout(() => {
                                        content.classList.remove('scale-50', 'opacity-0');
                                        content.classList.add('scale-100', 'opacity-100');
                                    }, 50);
                                }
                            }

                            function closeModal() {
                                const content = document.getElementById('modalContent');
                                const modal = document.getElementById('successModal');
                                if (content) {
                                    content.classList.remove('scale-100', 'opacity-100');
                                    content.classList.add('scale-50', 'opacity-0');
                                    setTimeout(() => {
                                        if (modal) modal.remove();
                                    }, 250);
                                }
                            }

                            document.addEventListener('DOMContentLoaded', showModal);
                        </script>
                    @endif

                    <!-- Full Name -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Full Name <span
                                class="text-rose-500">*</span></label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input type="text" name="full_name" required placeholder="For example, Keo Sokha"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs text-slate-800 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition">
                        </div>
                    </div>

                    <!-- Gender & Phone Number Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Gender -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Gender <span
                                    class="text-rose-500">*</span></label>
                            <select name="gender" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs text-slate-800 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition cursor-pointer">
                                <option value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Phone Number <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" name="phone" required placeholder="012 345 678"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs text-slate-800 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition">
                        </div>
                    </div>

                    <!-- Select Academic Course (Subject) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Select Academic Course <span
                                class="text-rose-500">*</span></label>
                        <select name="subject_id" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs text-slate-800 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition cursor-pointer">
                            <option value="">--- Choose a subject ---</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Additional Message -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Additional Message</label>
                        <textarea name="message" rows="3" placeholder="Write more information here..."
                            class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl text-xs text-slate-800 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition resize-none"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 px-6 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-rose-600/30 transition duration-200 flex items-center justify-center gap-2 cursor-pointer">
                        <span>Submit Form</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- FEATURE: Interactive FAQ Accordion Section -->
        <section class="max-w-4xl mx-auto space-y-4" data-aos="fade-up">
            <h3 class="text-xl font-bold text-slate-900 text-center mb-6">❓ FAQ - Frequently Asked Questions</h3>

            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                <button onclick="toggleFaq(1)"
                    class="w-full p-5 text-left font-bold text-slate-800 text-sm flex justify-between items-center bg-slate-50 hover:bg-slate-100 transition-colors">
                    <span>តើសាលាមានទទួលចុះឈ្មោះរៀងរាល់ថ្ងៃដែរឬទេ?</span>
                    <i id="faq-icon-1"
                        class="fa-solid fa-chevron-down text-slate-400 text-xs transition-transform duration-300"></i>
                </button>
                <div id="faq-answer-1" class="faq-answer px-5 text-slate-500 text-xs">
                    <p class="py-4 border-t border-slate-100">បាទ/ចាស! សាលាបើកទទួលការចុះឈ្មោះពីថ្ងៃច័ន្ទ ដល់ថ្ងៃសៅរ៍
                        តាមម៉ោងធ្វើការផ្លូវការ។</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                <button onclick="toggleFaq(2)"
                    class="w-full p-5 text-left font-bold text-slate-800 text-sm flex justify-between items-center bg-slate-50 hover:bg-slate-100 transition-colors">
                    <span>តើខ្ញុំអាចសាកសួរព័ត៌មានបន្ថែមតាមវិធីណាខ្លះ?</span>
                    <i id="faq-icon-2"
                        class="fa-solid fa-chevron-down text-slate-400 text-xs transition-transform duration-300"></i>
                </button>
                <div id="faq-answer-2" class="faq-answer px-5 text-slate-500 text-xs">
                    <p class="py-4 border-t border-slate-100">លោកអ្នកអាចបំពេញ Admission Form ខាងលើ ឬទំនាក់ទំនងផ្ទាល់តាម
                        Telegram ផ្លូវការរបស់សាលា។</p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-6 text-center text-slate-500 text-sm">
        <p>© 2026 CYBERTECH ACADEMY. All rights reserved.</p>
    </footer>

    <!-- Interactive JavaScript Logic -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Branch Switching Data & Logic
        const branches = {
            phnompenh: {
                address: "Building 123, Street 2004, Sangkat Kakap, Khan Por Sen Chey, Phnom Penh",
                email: "info@cybertech.edu.kh",
                phone: "+855 12 345 678 / +855 98 765 432",
                map: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.773981882046!2d104.8722!3d11.5685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109519fe40f252d%3A0xb35a9094038a3915!2sPhnom%20Penh!5e0!3m2!1sen!2skh!4v1700000000000!5m2!1sen!2skh"
            },
            siemreap: {
                address: "Road 6, Sivatha Rd, Krong Siem Reap",
                email: "sr.info@cybertech.edu.kh",
                phone: "+855 63 964 111 / +855 17 888 999",
                map: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62058.4632130768!2d103.8217!3d13.3671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3110173f478355cb%3A0x6212bf8b3b3b!2sSiem%20Reap!5e0!3m2!1sen!2skh!4v1700000000000!5m2!1sen!2skh"
            }
        };

        function switchBranch(key) {
            document.querySelectorAll('.branch-btn').forEach(b => {
                b.classList.remove('bg-rose-600', 'text-white');
                b.classList.add('text-slate-400');
            });
            document.getElementById(`btn-${key}`).classList.add('bg-rose-600', 'text-white');

            document.getElementById('info-address').innerText = branches[key].address;
            document.getElementById('info-email').innerText = branches[key].email;
            document.getElementById('info-phone').innerText = branches[key].phone;
            document.getElementById('map-iframe').src = branches[key].map;
        }

        // Character Counter Logic
        function updateCounter() {
            const input = document.getElementById('messageInput');
            document.getElementById('charCounter').innerText = `${input.value.length} / 200`;
        }

        // Accordion FAQ Toggle Logic
        function toggleFaq(index) {
            const answer = document.getElementById(`faq-answer-${index}`);
            const icon = document.getElementById(`faq-icon-${index}`);
            answer.classList.toggle('open');
            icon.classList.toggle('rotate-180');
        }

        // Async Form Submit Simulation
        function handleFormSubmit(event) {
            event.preventDefault();
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');

            btnText.innerText = "Submitting...";
            btnIcon.className = "fa-solid fa-spinner animate-spin text-xs";

            setTimeout(() => {
                Swal.fire({
                    title: '🎉 ផ្ញើព័ត៌មានជោគជ័យ!',
                    text: 'ក្រុមការងារ CyberTech Academy នឹងទាក់ទងទៅកាន់លោកអ្នកក្នុងពេលឆាប់ៗនេះ។',
                    icon: 'success',
                    confirmButtonColor: '#e11d48',
                    confirmButtonText: 'យល់ព្រម'
                }).then(() => {
                    document.getElementById('admissionForm').reset();
                    updateCounter();
                    btnText.innerText = "Submit Form";
                    btnIcon.className = "fa-solid fa-paper-plane text-xs";
                });
            }, 1200);
        }
    </script>
</body>

</html>
