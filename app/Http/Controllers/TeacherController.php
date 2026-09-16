<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        // ១. ចាប់យកថ្ងៃ Filter (បើគ្មាន Filter ទេ យកថ្ងៃនេះជា Default)
        $selectedDate = $request->get('date', now()->format('Y-m-d'));

        // ២. ទាញយក Teachers ជាមួយ Relation 'schoolClass' និង 'attendances'
        $teachers = Teacher::with(['schoolClass', 'attendances'])->latest()->paginate(10);

        // ៣. បោះ $teachers និង $selectedDate ទៅកាន់ Blade View
        return view('teachers.index', compact('teachers', 'selectedDate'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        return view('teachers.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_code'  => 'required|unique:teachers,teacher_code',
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'class'         => ['required', Rule::in(['A01', 'A02', 'A03', 'A04', 'A05', 'A06', 'A07', 'A08'])],
            'email'         => 'required|email|unique:teachers,email',
            'phone'         => 'nullable|string',
            'address'       => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ស្វែងរក SchoolClass
        $schoolClass = SchoolClass::where('name', $request->class)->first();

        // ពិនិត្យក្រែងលោស្វែងរកមិនឃើញ Class
        if (!$schoolClass) {
            return redirect()->back()->withInput()->withErrors(['class' => 'ថ្នាក់រៀនដែលបានជ្រើសរើសមិនត្រឹមត្រូវទេ!']);
        }

        unset($validated['class']);
        $validated['school_class_id'] = $schoolClass->id;

        // Upload រូបភាព
        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('profiles/teachers', 'public');
        }

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'បន្ថែមទិន្នន័យគ្រូបង្រៀនបានជោគជ័យ!');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $classes = ['A01', 'A02', 'A03', 'A04', 'A05', 'A06', 'A07', 'A08'];

        return view('teachers.edit', compact('teacher', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validated = $request->validate([
            'teacher_code'  => 'required|unique:teachers,teacher_code,' . $teacher->id,
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'class'         => ['required', Rule::in(['A01', 'A02', 'A03', 'A04', 'A05', 'A06', 'A07', 'A08'])],
            'phone'         => 'nullable|string|max:20',
            'email'         => 'required|email|max:255|unique:teachers,email,' . $teacher->id,
            'address'       => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $schoolClass = SchoolClass::where('name', $request->class)->first();

        unset($validated['class']);
        $validated['school_class_id'] = $schoolClass ? $schoolClass->id : null;

        if ($request->hasFile('profile_image')) {
            if ($teacher->profile_image && Storage::disk('public')->exists($teacher->profile_image)) {
                Storage::disk('public')->delete($teacher->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('profiles/teachers', 'public');
        }

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'កែប្រែទិន្នន័យជោគជ័យ!');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->profile_image && Storage::disk('public')->exists($teacher->profile_image)) {
            Storage::disk('public')->delete($teacher->profile_image);
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'លុបទិន្នន័យគ្រូបង្រៀនបានជោគជ័យ!');
    }
}