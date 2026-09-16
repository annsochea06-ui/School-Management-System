<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['attendances' => function ($q) {
            $q->where('date', today());
        }])->get();

        return view('teacher_attendances.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attendances' => 'required|array',
            'date' => 'required|date',
        ]);

        foreach ($request->attendances as $teacherId => $status) {
            TeacherAttendance::updateOrCreate(
                [
                    'teacher_id' => $teacherId,
                    'date' => $request->date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return back()->with('success', 'កត់ត្រាវត្តមានគ្រូបង្រៀនបានជោគជ័យ!');
    }
}