@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <!-- Flash Success Notification -->
        @if (session('success'))
            <div
                class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    {{ session('success') }}
                </span>
                <button type="button" onclick="this.parentElement.remove()"
                    class="text-emerald-400 hover:text-emerald-200 text-lg">&times;</button>
            </div>
        @endif

        <!-- Page Header & Add Button -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <span class="typing-title text-2xl font-bold text-white" data-text="CYBERTECH ACADEMY STUDENTS"></span><span class="typing-cursor text-4xl">|</span>
                <p class="text-xs text-slate-400 mt-1">
                    Manage and view all enrolled student records.
                </p>
            </div>

            <a href="{{ route('students.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold shadow-lg shadow-indigo-600/30 transition duration-200">
                <i class="fa-solid fa-user-plus"></i>
                Add New Student
            </a>
        </div>

        <!-- Main Card Container -->
        <div
            class="bg-[#0f172a]/80 dark:bg-slate-900 shadow-2xl rounded-2xl border border-slate-800/80 overflow-hidden backdrop-blur-xl">

            <!-- Total Enrolled Badge Bar -->
            <div class="p-5 border-b border-slate-800/80 flex items-center gap-3">
                <span class="text-xs font-bold text-slate-300">Total Enrolled:</span>
                <span
                    class="px-3 py-1 rounded-lg bg-indigo-950/80 border border-indigo-800/50 text-indigo-400 text-xs font-bold">
                    {{ $students->count() }} Students
                </span>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead
                        class="bg-[#0b1329] text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-800/80">
                        <tr>
                            <th class="py-4 px-6 text-left">PROFILE</th>
                            <th class="py-4 px-4 text-left">STUDENT CODE</th>
                            <th class="py-4 px-4 text-left">FULL NAME</th>
                            <th class="py-4 px-4 text-center">CLASS</th>
                            <th class="py-4 px-4 text-center">GENDER</th>
                            <th class="py-4 px-4 text-left">PHONE NUMBER</th>
                            <th class="py-4 px-4 text-left">PARENT PHONE</th>
                            <th class="py-4 px-4 text-left">CREATED BY</th>
                            <th class="py-4 px-6 text-right">ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-800/50 text-xs font-medium text-slate-300">
                        @forelse($students as $student)
                            <tr class="hover:bg-slate-800/30 transition-colors duration-150">

                                <!-- Profile Image -->
                                <td class="py-3 px-6">
                                    <div
                                        class="w-10 h-10 rounded-full overflow-hidden border border-slate-700 bg-slate-800 flex-shrink-0">
                                        <img src="{{ $student->profile_image ? asset('storage/' . $student->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($student->first_name . ' ' . $student->last_name) . '&background=6366f1&color=fff' }}"
                                            alt="Profile" class="w-full h-full object-cover">
                                    </div>
                                </td>

                                <!-- Student Code -->
                                <td class="py-3 px-4 font-mono font-bold text-indigo-400">
                                    {{ $student->student_code }}
                                </td>

                                <!-- Full Name -->
                                <td class="py-3 px-4 font-bold text-white">
                                    {{ $student->last_name }} {{ $student->first_name }}
                                </td>

                                <!-- Class Badge -->
                                <td class="py-3 px-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full text-[11px] font-semibold bg-slate-800 border border-slate-700 text-slate-300">
                                        {{ $student->schoolClass->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <!-- Gender Badge -->
                                <td class="py-3 px-4 text-center">
                                    @if (in_array(strtolower($student->gender), ['male', 'ប្រុស']))
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 font-semibold text-[11px]">
                                            <i class="fa-solid fa-mars text-[10px]"></i> Male
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-400 font-semibold text-[11px]">
                                            <i class="fa-solid fa-venus text-[10px]"></i> Female
                                        </span>
                                    @endif
                                </td>

                                <!-- Contact -->
                                <td class="py-3 px-4 font-mono text-slate-300">
                                    {{ $student->phone ?? '-' }}
                                </td>
                                <td class="py-3 px-4 font-mono text-slate-300">
                                    {{ $student->parent_phone ?? '-' }}
                                </td>

                                <!-- Created By -->
                                <td class="py-3 px-4 text-slate-300">
                                    {{ $student->user->name ?? 'Admin' }}
                                </td>

                                <!-- Actions -->
                                <td class="py-3 px-6 text-right">
                                    <div class="inline-flex items-center justify-end gap-2">
                                        <!-- Edit Button (Open Modal) -->
                                        <button type="button" onclick="openEditModal({{ $student->id }})"
                                            class="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/20 text-amber-500 hover:bg-amber-500 hover:text-slate-950 flex items-center justify-center transition duration-150"
                                            title="Edit Student">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            id="delete-form-{{ $student->id }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="if(confirm('Are you sure you want to delete this student record?')) { document.getElementById('delete-form-{{ $student->id }}').submit(); }"
                                                class="w-8 h-8 rounded-lg bg-rose-500/10 border border-rose-500/20 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center transition duration-150"
                                                title="Delete Student">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-12 text-center text-slate-500">
                                    <div class="max-w-xs mx-auto space-y-3">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-slate-800/50 text-slate-500 flex items-center justify-center mx-auto text-xl">
                                            <i class="fa-solid fa-user-slash"></i>
                                        </div>
                                        <p class="font-bold text-sm text-slate-400">No Students Found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= MODALS SECTION (រៀបចំនៅខាងក្រៅ Table ដើម្បីឱ្យ Center លើអេក្រង់) ================= -->
    @foreach ($students as $student)
        <!-- កែពី class  cũ មកជា Class នេះ -->
        <div id="edit-modal-{{ $student->id }}"
            class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
            <div
                class="bg-[#0f172a] rounded-2xl shadow-2xl w-full max-w-xl border border-slate-800 flex flex-col max-h-[90vh] overflow-hidden">

                <!-- Modal Header -->
                <div class="p-6 border-b border-slate-800/60 flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-white tracking-wide">
                            Update Student Info
                        </h3>
                        <p class="text-xs text-slate-400 mt-1">
                            កែប្រែព័ត៌មានសិស្ស៖ {{ $student->first_name }} {{ $student->last_name }}
                        </p>
                    </div>
                    <button type="button" onclick="closeEditModal({{ $student->id }})"
                        class="text-slate-400 hover:text-white text-xl font-medium transition-colors">
                        &times;
                    </button>
                </div>

                <!-- Form Edit Student -->
                <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data"
                    class="p-5 space-y-3.5 overflow-y-auto flex-1">

                    @csrf
                    @method('PUT')

                    <div class="flex items-center gap-4 p-3 rounded-xl bg-[#0b1329] border border-slate-800">
                        <!-- Present Profile Image -->
                        <div
                            class="w-14 h-14 rounded-full overflow-hidden border-2 border-indigo-500/50 flex-shrink-0 bg-slate-800">
                            <img id="preview-img-{{ $student->id }}"
                                src="{{ $student->profile_image ? asset('storage/' . $student->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($student->first_name . ' ' . $student->last_name) . '&background=6366f1&color=fff' }}"
                                alt="Profile Preview" class="w-full h-full object-cover">
                        </div>

                        <!-- File Input -->
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-slate-300 mb-1">
                                Change Profile Image
                            </label>
                            <input type="file" name="profile_image" accept="image/*"
                                onchange="previewImage(event, {{ $student->id }})"
                                class="block w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/20 file:text-indigo-400 hover:file:bg-indigo-600/30 cursor-pointer">
                            <span class="text-[10px] text-slate-500 mt-1 block">JPG, PNG, WEBP max 2MB</span>
                        </div>
                    </div>

                    <!-- Select Class -->
                    <div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Select Class <span class="text-indigo-400">*</span>
                            </label>
                            <select name="school_class_id" required
                                class="w-full text-xs font-medium rounded-xl border border-slate-800 bg-[#0b1329] text-slate-200 px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 focus:outline-none transition">
                                <option value="">-- Choose Class --</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ $student->school_class_id == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Status <span class="text-indigo-400">*</span>
                            </label>
                            <select name="status" required
                                class="w-full text-xs font-medium rounded-xl border border-slate-800 bg-[#0b1329] text-slate-200 px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 focus:outline-none transition">
                                <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- First Name & Last Name (2 Columns) -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">
                                First Name <span class="text-indigo-400">*</span>
                            </label>
                            <input type="text" name="first_name"
                                value="{{ old('first_name', $student->first_name) }}" required placeholder="First Name"
                                class="w-full text-xs font-medium rounded-xl border border-slate-800 bg-[#0b1329] text-slate-200 px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Last Name <span class="text-indigo-400">*</span>
                            </label>
                            <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}"
                                required placeholder="Last Name"
                                class="w-full text-xs font-medium rounded-xl border border-slate-800 bg-[#0b1329] text-slate-200 px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 focus:outline-none transition">
                        </div>
                    </div>

                    <!-- Gender & Student Code (2 Columns) -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Gender <span class="text-indigo-400">*</span>
                            </label>
                            <select name="gender" required
                                class="w-full text-xs font-medium rounded-xl border border-slate-800 bg-[#0b1329] text-slate-200 px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 focus:outline-none transition">
                                <option value="male" {{ strtolower($student->gender) == 'male' ? 'selected' : '' }}>Male
                                    / ប្រុស</option>
                                <option value="female" {{ strtolower($student->gender) == 'female' ? 'selected' : '' }}>
                                    Female / ស្រី</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Student Code
                            </label>
                            <input type="text" name="student_code"
                                value="{{ old('student_code', $student->student_code) }}" placeholder="STD-1001"
                                class="w-full text-xs font-medium rounded-xl border border-slate-800 bg-[#0b1329] text-slate-200 px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 focus:outline-none transition">
                        </div>
                    </div>

                    <!-- Phone & Parent Phone (2 Columns) -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Phone Number
                            </label>
                            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                                placeholder="012 345 678"
                                class="w-full text-xs font-medium rounded-xl border border-slate-800 bg-[#0b1329] text-slate-200 px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Parent Phone
                            </label>
                            <input type="text" name="parent_phone"
                                value="{{ old('parent_phone', $student->parent_phone) }}" placeholder="098 765 432"
                                class="w-full text-xs font-medium rounded-xl border border-slate-800 bg-[#0b1329] text-slate-200 px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 focus:outline-none transition">
                        </div>

                        <!-- Status Selection -->

                    </div>

                    <!-- Buttons Action (Cancel & Update) -->
                    <div class="pt-4 flex justify-end items-center gap-3">
                        <button type="button" onclick="closeEditModal({{ $student->id }})"
                            class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl transition duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold rounded-xl shadow-lg shadow-indigo-600/30 transition duration-200 flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk text-xs"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- JavaScript to control Modal Open/Close -->
    <script>
        function openEditModal(id) {
            document.getElementById('edit-modal-' + id).classList.remove('hidden');
        }

        function closeEditModal(id) {
            document.getElementById('edit-modal-' + id).classList.add('hidden');
        }
    </script>
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
