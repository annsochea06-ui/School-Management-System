@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        <!-- Header & Navigation -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('students.index') }}"
                    class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 flex items-center justify-center transition shadow-sm">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">បន្ថែមសិស្សថ្មី</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Register a new student profile into the system.</p>
                </div>
            </div>
        </div>

        <!-- Display Validation Errors (បើមានកំហុសនឹងបង្ហាញទីនេះ) -->
        @if ($errors->any())
            <div
                class="p-4 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800/60 rounded-2xl text-xs text-rose-600 dark:text-rose-400 space-y-1">
                <p class="font-bold">សូមពិនិត្យមើលកំហុសខាងក្រោម៖</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Body -->
        <div
            class="bg-white dark:bg-[#0f172a] rounded-3xl border border-slate-200/80 dark:border-slate-800/80 shadow-xl overflow-hidden p-6 sm:p-8 transition-all duration-300">

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Avatar Preview -->
                <div x-data="{ imagePreview: 'https://ui-avatars.com/api/?name=Student&background=6366f1&color=fff' }"
                    class="flex flex-col sm:flex-row items-center gap-6 p-4 rounded-2xl bg-slate-50/50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800/60">

                    <div
                        class="relative w-20 h-20 rounded-2xl overflow-hidden border-2 border-indigo-500/30 shadow-md flex-shrink-0">
                        <img :src="imagePreview" alt="Profile Preview" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1 w-full">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">រូបថត Profile (
                            profile_image )</label>
                        <input type="file" name="profile_image" accept="image/*"
                            @change="const file = $event.target.files[0]; if (file) imagePreview = URL.createObjectURL(file)"
                            class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 transition cursor-pointer">
                        @error('profile_image')
                            <span class="text-rose-500 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Student Code & School Class ID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">អត្តលេខសិស្ស (
                            student_code ) <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <i class="fa-solid fa-hashtag absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                            <input type="text" name="student_code" value="{{ old('student_code') }}"
                                placeholder="STU-001" required
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-mono font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        </div>
                        @error('student_code')
                            <span class="text-rose-500 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-300">
                            Select Class <span class="text-rose-500">*</span>
                        </label>

                        <label for="school_class_id" class="block text-sm font-medium">Select Class <span
                                class="text-red-500">*</span></label>

                        <select name="school_class_id" id="school_class_id" required
                            class="w-full bg-slate-800 text-white border border-slate-700 rounded-lg p-2.5">
                            <option value="">-- Choose Class --</option>

                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">
                                    {{ $class->name }} {{-- ឬ $class->class_name ទៅតាមឈ្មោះ Column ក្នុង Database របស់អ្នក --}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- First Name & Last Name -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">គោត្តនាម ( last_name
                            ) <span class="text-rose-500">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="បញ្ចូលគោត្តនាម"
                            required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        @error('last_name')
                            <span class="text-rose-500 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">នាម ( first_name )
                            <span class="text-rose-500">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="បញ្ចូលនាម"
                            required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        @error('first_name')
                            <span class="text-rose-500 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Gender & Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">ភេទ ( gender ) <span
                                class="text-rose-500">*</span></label>
                        <select name="gender" required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition cursor-pointer">
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ប្រុស (Male)</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>ស្រី (Female)</option>
                        </select>
                        @error('gender')
                            <span class="text-rose-500 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">ស្ថានភាព ( status )
                            <span class="text-rose-500">*</span></label>
                        <select name="status" required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition cursor-pointer">
                            <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>កំពុងរៀន
                                (Active)</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>ផ្អាក (Inactive)
                            </option>
                        </select>
                        @error('status')
                            <span class="text-rose-500 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Phone & Parent Phone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">លេខទូរស័ព្ទ ( phone
                            )</label>
                        <div class="relative">
                            <i class="fa-solid fa-phone absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="012 345 678"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-mono font-semibold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        </div>
                        @error('phone')
                            <span class="text-rose-500 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">លេខអាណាព្យាបាល (
                            parent_phone )</label>
                        <div class="relative">
                            <i class="fa-solid fa-user-shield absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                            <input type="text" name="parent_phone" value="{{ old('parent_phone') }}"
                                placeholder="098 765 432"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-mono font-semibold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        </div>
                        @error('parent_phone')
                            <span class="text-rose-500 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-800/80">
                    <a href="{{ route('students.index') }}"
                        class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-2xl text-xs font-bold transition">
                        បោះបង់
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-xs font-bold transition shadow-lg shadow-indigo-600/30 flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>រក្សាទុកទិន្នន័យ (Save Student)</span>
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
