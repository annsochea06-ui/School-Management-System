<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::with(['schoolClass', 'subject', 'teacher'])->get();
        return view('timetable.index', compact('timetables'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('timetable.create', compact('classes', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id'      => 'required|exists:subjects,id',
            'teacher_id'      => 'required|exists:teachers,id',
            'room_name'       => 'required|string',
            'day_of_week'     => 'required|string',
            'start_time'      => 'required',
            'end_time'        => 'required',
        ]);

        Timetable::create($validated);

        return redirect()->route('timetables.index')->with('success', 'បង្កើតកាលវិភាគបានជោគជ័យ!');
    }
}