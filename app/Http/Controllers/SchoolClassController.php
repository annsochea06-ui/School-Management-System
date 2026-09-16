<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    // List Static Classes (A01 -> A08)
    public function index()
    {
        $classes = ['A01', 'A02', 'A03', 'A04', 'A05', 'A06', 'A07', 'A08'];
        return view('classes.index', compact('classes'));
    }

    // Show Class Details, Teacher & Student List
    public function show($className)
    {
        // ទាញយកសិស្សណាដែលមានឈ្មោះថ្នាក់រៀន (A01, A02...) ត្រូវគ្នាជាមួយ $className
        $students = Student::whereHas('schoolClass', function ($query) use ($className) {
            $query->where('name', $className);
        })->get();

        // ទាញយកទិន្នន័យគ្រូបង្រៀនក្នុងថ្នាក់នោះដែរ
        $teachers = Teacher::whereHas('schoolClass', function ($query) use ($className) {
            $query->where('name', $className);
        })->get();

        $totalStudents = $students->count();

        return view('classes.show', compact('className', 'students', 'teachers', 'totalStudents'));
    }

    // Save/Update Attendance
    public function storeAttendance(Request $request, $class_code)
    {
        $request->validate([
            'attendances' => 'required|array',
            'date'        => 'required|date',
        ]);

        foreach ($request->attendances as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date'       => $request->date,
                ],
                [
                    'class_code' => $class_code,
                    'status'     => $status,
                ]
            );
        }

        return redirect()->back()->with('success', 'កត់ត្រាវត្តមានបានជោគជ័យ!');
    }
}