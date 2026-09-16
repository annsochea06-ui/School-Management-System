<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // ១. បង្ហាញបញ្ជីសិស្ស
    public function index()
    {
        $students = Student::with('schoolClass')->get();
        $classes = SchoolClass::all(); // 2. ទាញយកទិន្នន័យ Classes ទាំងអស់

        // 3. បញ្ជូន $classes ទៅកាន់ View ជាមួយ $students
        return view('students.index', compact('students', 'classes'));
    }

    // ២. បង្ហាញ Form បន្ថែមសិស្ស
    public function create()
    {
        // ទាញយកថ្នាក់រៀនទាំងអស់ចេញពី Database
        $classes = SchoolClass::all();

        // កែប្រែពី 'your_view_name' មកជា View ពិតប្រាកដ 'students.create'
        return view('students.create', compact('classes'));
    }

    // ៣. រក្សាទុកទិន្នន័យ និង Upload រូបថត
    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'student_code'    => 'nullable|string|max:50',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'gender'          => 'required',
            'phone'           => 'nullable|string|max:20',
            'parent_phone'    => 'nullable|string|max:20',
            'status'          => 'required',
            'profile_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ចាប់យក ID របស់ Admin/User ដែលកំពុង Login (បើមិនទាន់ Login វានឹងយក ID 1 ស្វ័យប្រវត្តិ)
        $validated['user_id'] = auth()->check() ? auth()->id() : 1;

        // រក្សាទុក រូបថត profile (បើមាន)
        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('profiles/students', 'public');
        }

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'បន្ថែមទិន្នន័យសិស្សបានជោគជ័យ!');
    }

    // ៤. បង្ហាញ Form កែប្រែទិន្នន័យ
    public function edit(Student $student)
    {
        $classes = SchoolClass::all();
        return view('students.edit', compact('student', 'classes'));
    }

    // ៥. រក្សាទុកការកែប្រែ (Update)
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'user_id'         => 'nullable|exists:users,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'student_code'    => 'nullable|string|max:50',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'gender'          => 'required|in:male,female',
            'phone'           => 'nullable|string|max:20',
            'parent_phone'    => 'nullable|string|max:20',
            'status'          => 'nullable|string', // <--- ដូរទៅ nullable ព្រោះក្នុង Modal អត់មាន Input នេះទេ
            'profile_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // កែច្នៃការ Upload រូបភាព
        if ($request->hasFile('profile_image')) {
            if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
                Storage::disk('public')->delete($student->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('profiles/students', 'public');
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'កែប្រែទិន្នន័យសិស្សបានជោគជ័យ!');
    }

    // ៦. លុបទិន្នន័យ (Delete)
    public function destroy(Student $student)
    {
        if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
            Storage::disk('public')->delete($student->profile_image);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'លុបទិន្នន័យសិស្សបានជោគជ័យ!');
    }
}
