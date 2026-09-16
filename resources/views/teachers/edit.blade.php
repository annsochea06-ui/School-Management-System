@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        <!-- Page Header & Navigation Back -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('students.index') }}"
                    class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 flex items-center justify-center transition shadow-sm">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Update Teacher</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Edit and update student profile parameters.</p>
                </div>
            </div>

            {{-- <span
                class="px-3 py-1 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-mono font-bold text-xs border border-indigo-100 dark:border-indigo-500/20">
                ID: {{ $teacher->teacher_code }}
            </span> --}}
        </div>

        <!-- Edit Form Card Container -->
        <div
            class="bg-white dark:bg-[#0f172a] rounded-3xl border border-slate-200/80 dark:border-slate-800/80 shadow-xl overflow-hidden p-6 sm:p-8 transition-all duration-300">

            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Image Upload Preview Section -->
    <div x-data="{ imagePreview: '{{ $teacher->profile_image ? asset('storage/' . $teacher->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->first_name . ' ' . $teacher->last_name) . '&background=6366f1&color=fff' }}' }"
        class="flex flex-col sm:flex-row items-center gap-6 p-4 rounded-2xl bg-slate-50/50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800/60">

        <div class="relative w-20 h-20 rounded-2xl overflow-hidden border-2 border-indigo-500/30 shadow-md flex-shrink-0">
            <img :src="imagePreview" alt="Profile Preview" class="w-full h-full object-cover">
        </div>

        <div class="flex-1 w-full">
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">
                Profile Image
            </label>
            <input type="file" name="profile_image" accept="image/*"
                @change="const file = $event.target.files[0]; if (file) imagePreview = URL.createObjectURL(file)"
                class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 transition cursor-pointer">
        </div>
    </div>

    <!-- Field: Teacher Code -->
    <div>
        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">
            Teacher Code <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
            <i class="fa-solid fa-hashtag absolute left-4 top-3.5 text-slate-400 text-xs"></i>
            <input type="text" name="teacher_code" value="{{ old('teacher_code', $teacher->teacher_code) }}" required
                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-mono font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
        </div>
    </div>

    <!-- Fields: Last Name & First Name -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">
                Last Name <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="last_name" value="{{ old('last_name', $teacher->last_name) }}" required
                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">
                First Name <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="first_name" value="{{ old('first_name', $teacher->first_name) }}" required
                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
        </div>
    </div>

    <!-- Fields: Class & Address -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">
                Class <span class="text-rose-500">*</span>
            </label>
            <select name="class" required
                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-bold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition cursor-pointer">
                <option value="">-- Choose Class --</option>
                @foreach ($classes as $class)
                    <option value="{{ $class }}" {{ old('class', $teacher->class ?? '') == $class ? 'selected' : '' }}>
                        Class {{ $class }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Address</label>
            <div class="relative">
                <i class="fa-solid fa-house absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                <input type="text" name="address" value="{{ old('address', $teacher->address) }}"
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-semibold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
            </div>
        </div>
    </div>

    <!-- Fields: Phone & Email -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Phone</label>
            <div class="relative">
                <i class="fa-solid fa-phone absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}"
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-mono font-semibold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Email</label>
            <div class="relative">
                <i class="fa-solid fa-envelope absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                <input type="email" name="email" value="{{ old('email', $teacher->email) }}"
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-semibold text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
            </div>
        </div>
    </div>

    <!-- Action Buttons Footer -->
    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-800/80">
        <a href="{{ route('teachers.index') }}"
            class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-2xl text-xs font-bold transition">
            Cancel
        </a>
        <button type="submit"
            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-xs font-bold transition shadow-lg shadow-indigo-600/30 flex items-center gap-2">
            <i class="fa-solid fa-floppy-disk text-xs"></i>
            <span>Update</span>
        </button>
    </div>

</form>
        </div>

    </div>
@endsection
