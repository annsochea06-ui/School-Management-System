@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        <!-- Page Header & Navigation Back -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('teachers.index') }}"
                    class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 flex items-center justify-center transition shadow-sm">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">បន្ថែមគ្រូបង្រៀនថ្មី</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Register a new teacher into the system.</p>
                </div>
            </div>
        </div>

        <!-- Form Card Container -->
        <div
            class="bg-white dark:bg-[#0f172a] rounded-3xl border border-slate-200/80 dark:border-slate-800/80 shadow-xl overflow-hidden p-6 sm:p-8 transition-all duration-300">

            <!-- ⚠️ បង្ហាញ Validation Errors (ប្រសិនបើមាន) -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs space-y-1">
                    <div class="font-bold flex items-center gap-2 mb-1">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>សូមពិនិត្យមើលព័ត៌មានខាងក្រោម៖</span>
                    </div>
                    <ul class="list-disc pl-5 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Image Upload Preview Section -->
                <div x-data="{ imagePreview: 'https://ui-avatars.com/api/?name=Teacher&background=6366f1&color=fff' }"
                    class="flex flex-col sm:flex-row items-center gap-6 p-4 rounded-2xl bg-slate-50/50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800/60">

                    <div
                        class="relative w-20 h-20 rounded-2xl overflow-hidden border-2 border-indigo-500/30 shadow-md flex-shrink-0">
                        <img :src="imagePreview" alt="Profile Preview" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1 w-full">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">
                            រូបថត Profile ( profile_image )
                        </label>
                        <input type="file" name="profile_image" accept="image/*"
                            @change="const file = $event.target.files[0]; if (file) imagePreview = URL.createObjectURL(file)"
                            class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 transition cursor-pointer">
                    </div>
                </div>

                <!-- Field: Teacher Code -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">អត្តលេខគ្រូ (
                        teacher_code ) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <i class="fa-solid fa-hashtag absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                        <input type="text" name="teacher_code" value="{{ old('teacher_code') }}" placeholder="TCH-001" required
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-mono font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <!-- Fields: Last Name & First Name -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">គោត្តនាម ( last_name
                            ) <span class="text-rose-500">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="បញ្ចូលគោត្តនាម" required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">នាម ( first_name )
                            <span class="text-rose-500">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="បញ្ចូលនាម" required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <!-- Fields: Class & Phone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">ថ្នាក់សិក្សា ( Class
                            ) <span class="text-rose-500">*</span></label>
                        <select name="class" required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition cursor-pointer">
                            <option value="">-- ជ្រើសរើសថ្នាក់ --</option>
                            @for ($i = 1; $i <= 8; $i++)
                                @php $className = 'A' . str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                <option value="{{ $className }}" {{ old('class') == $className ? 'selected' : '' }}>Class {{ $className }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">លេខទូរស័ព្ទ ( phone
                            )</label>
                        <div class="relative">
                            <i class="fa-solid fa-phone absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="012 345 678"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-mono font-semibold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        </div>
                    </div>
                </div>

                <!-- Field: Email -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">អ៊ីមែល ( email ) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                        <!-- ⚠️ បានបន្ថែម required ឱ្យត្រូវតាម Controller -->
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="teacher@school.edu.kh" required
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-semibold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <!-- Field: Address -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">អាសយដ្ឋាន ( address
                        )</label>
                    <textarea name="address" rows="3" placeholder="បញ្ចូលអាសយដ្ឋានបច្ចុប្បន្ន..."
                        class="w-full p-4 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-semibold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">{{ old('address') }}</textarea>
                </div>

                <!-- Action Buttons Footer -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-800/80">
                    <a href="{{ route('teachers.index') }}"
                        class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-2xl text-xs font-bold transition">
                        បោះបង់
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-xs font-bold transition shadow-lg shadow-indigo-600/30 flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>រក្សាទុកទិន្នន័យ (Save)</span>
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection