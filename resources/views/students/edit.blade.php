@extends('layouts.app') <!-- ឬ 'layouts.admin' ទៅតាមឈ្មោះ Layout file របស់អ្នក -->

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    
    <!-- Flash Success Notification -->
    @if(session('success'))
        <div class="mb-4 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-bold flex items-center justify-between">
            <span><i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 shadow-xl rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <!-- Table Header -->
                <thead class="bg-slate-50/80 text-center dark:bg-slate-950/50 border-b border-slate-100 dark:border-slate-800/80 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="p-4 pl-6">Profile</th>
                        <th class="p-4">Student Code</th>
                        <th class="p-4">Full Name</th>
                        <th class="p-4">Class</th>
                        <th class="p-4">Gender</th>
                        <th class="p-4">Phone Number</th>
                        <th class="p-4">Parent Phone</th>
                        <th class="p-4">Created By</th>
                        <th class="p-4 pr-6 text-right">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-semibold text-slate-700 dark:text-slate-300">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="p-4 pl-6">
                                <img src="{{ $student->profile_image ? asset('storage/' . $student->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($student->first_name . ' ' . $student->last_name) . '&background=6366f1&color=fff' }}"
                                    alt="Profile" class="w-10 h-10 rounded-2xl object-cover border border-slate-200 dark:border-slate-700 shadow-sm">
                            </td>

                            <td class="p-4 font-mono font-bold text-indigo-600 dark:text-indigo-400">
                                {{ $student->student_code }}
                            </td>

                            <td class="p-4 font-bold text-slate-900 dark:text-white">
                                {{ $student->last_name }} {{ $student->first_name }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-slate-800 text-slate-300">
                                    {{ $student->schoolClass->name ?? 'N/A' }}
                                </span>
                            </td>

                            <td class="p-4">
                                @if ($student->gender == 'male' || $student->gender == 'ប្រុស')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 font-bold text-[11px]">
                                        <i class="fa-solid fa-mars text-[10px]"></i> Male
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 font-bold text-[11px]">
                                        <i class="fa-solid fa-venus text-[10px]"></i> Female
                                    </span>
                                @endif
                            </td>

                            <td class="p-4 text-slate-500 dark:text-slate-400 font-mono">
                                {{ $student->phone ?? '-' }}
                            </td>
                            <td class="p-4 text-slate-500 dark:text-slate-400 font-mono">
                                {{ $student->parent_phone ?? '-' }}
                            </td>

                            <td class="px-6 py-4 font-medium text-slate-200">
                                {{ $student->user->name ?? 'Admin' }}
                            </td>

                            <!-- Action Buttons -->
                            <td class="p-4 pr-6 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button type="button" 
                                        onclick="document.getElementById('edit-modal-{{ $student->id }}').classList.remove('hidden')" 
                                        class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm"
                                        title="Edit Record">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>

                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" id="delete-form-{{ $student->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="if(confirm('Are you sure you want to delete this student?')) { document.getElementById('delete-form-{{ $student->id }}').submit(); }"
                                            class="w-8 h-8 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-500 hover:text-white flex items-center justify-center transition shadow-sm"
                                            title="Delete Record">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- EDIT MODAL COMPONENT -->
                                <div id="edit-modal-{{ $student->id }}" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                                    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden border border-slate-200 dark:border-slate-800">
                                        
                                        <div class="p-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                                            <h3 class="font-bold text-slate-800 dark:text-white text-sm flex items-center gap-2">
                                                <i class="fa-solid fa-user-pen text-indigo-500"></i> កែប្រែទិន្នន័យសិស្ស៖ {{ $student->first_name }} {{ $student->last_name }}
                                            </h3>
                                            <button type="button" 
                                                onclick="document.getElementById('edit-modal-{{ $student->id }}').classList.add('hidden')" 
                                                class="text-slate-400 hover:text-slate-600 dark:hover:text-white text-lg font-bold">
                                                &times;
                                            </button>
                                        </div>

                                        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                                            @csrf
                                            @method('PUT')

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Student Code</label>
                                                    <input type="text" name="student_code" value="{{ old('student_code', $student->student_code) }}" 
                                                        class="w-full text-xs rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 text-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Class <span class="text-rose-500">*</span></label>
                                                    <select name="school_class_id" required class="w-full text-xs rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 text-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                                        @foreach($classes as $class)
                                                            <option value="{{ $class->id }}" {{ $student->school_class_id == $class->id ? 'selected' : '' }}>
                                                                {{ $class->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">First Name <span class="text-rose-500">*</span></label>
                                                    <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}" required 
                                                        class="w-full text-xs rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 text-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Last Name <span class="text-rose-500">*</span></label>
                                                    <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}" required 
                                                        class="w-full text-xs rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 text-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Gender <span class="text-rose-500">*</span></label>
                                                    <select name="gender" required class="w-full text-xs rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 text-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                                        <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male / ប្រុស</option>
                                                        <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female / ស្រី</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Status <span class="text-rose-500">*</span></label>
                                                    <select name="status" required class="w-full text-xs rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 text-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                                        <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Phone Number</label>
                                                    <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" 
                                                        class="w-full text-xs rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 text-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Parent Phone</label>
                                                    <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}" 
                                                        class="w-full text-xs rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 text-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Profile Image</label>
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ $student->profile_image ? asset('storage/' . $student->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($student->first_name . ' ' . $student->last_name) }}" 
                                                        alt="Avatar" class="w-10 h-10 rounded-xl object-cover border border-slate-200 dark:border-slate-700">
                                                    <input type="file" name="profile_image" accept="image/*" class="text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                                                </div>
                                            </div>

                                            <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-2">
                                                <button type="button" 
                                                    onclick="document.getElementById('edit-modal-{{ $student->id }}').classList.add('hidden')" 
                                                    class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                                                    បោះបង់ (Cancel)
                                                </button>
                                                <button type="submit" 
                                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-md transition flex items-center gap-1.5">
                                                    <i class="fa-solid fa-floppy-disk"></i> រក្សាទុក (Save)
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-12 text-center text-slate-400">
                                <div class="max-w-xs mx-auto space-y-3">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center mx-auto text-xl">
                                        <i class="fa-solid fa-user-slash"></i>
                                    </div>
                                    <p class="font-bold text-sm text-slate-600 dark:text-slate-300">No Students Found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection