<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input('date', date('Y-m-d'));
        $classId = $request->input('school_class_id');

        $query = Teacher::query();

        if (!empty($classId)) {
            $query->where('school_class_id', $classId);
        }

        // Fetch គ្រូទាំងអស់មកមុន
        $teachers = $query->with('schoolClass')->get();

        // ទាញយកវត្តមានសរុប និងវត្តមានប្រចាំថ្ងៃផ្ទាល់ដាច់ដោយឡែក
        foreach ($teachers as $teacher) {
            // ១. ទាញយក Status ប្រចាំថ្ងៃ Filter
            $todayAtt = Attendance::where('teacher_id', $teacher->id)
                ->whereDate('attendance_date', $selectedDate)
                ->first();

            $teacher->today_status = $todayAtt ? $todayAtt->status : 'not_marked';

            // ២. រាប់ចំនួនអវត្តមានសរុប (Absent/Permission) គ្រប់កាលបរិច្ឆេទ
            $teacher->unexcused_absent_count = Attendance::where('teacher_id', $teacher->id)
                ->whereIn('status', ['absent', 'absence'])
                ->count();

            $teacher->permission_count = Attendance::where('teacher_id', $teacher->id)
                ->where('status', 'permission')
                ->count();

            $teacher->total_absent_count = $teacher->unexcused_absent_count + $teacher->permission_count;
        }

        $totalTeachers = $teachers->count();
        $classes = SchoolClass::orderBy('name', 'asc')->get();

        return view('attendance.index', compact(
            'teachers',
            'selectedDate',
            'classes',
            'totalTeachers',
            'classId'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attendance'      => 'required|array',
            'attendance_date' => 'required|date',
        ]);

        foreach ($request->attendance as $teacherId => $status) {
            $statusValue = is_array($status) ? ($status['status'] ?? null) : $status;

            // បំលែងអក្សរទៅជាអក្សរតូចដើម្បីងាយស្រួលផ្ទៀងផ្ទាត់
            $lowerStatus = strtolower(trim($statusValue));

            // Format តម្លៃឱ្យត្រូវ standard មុនរក្សាទុកក្នុង Database
            if (in_array($lowerStatus, ['present', 'join'])) {
                $formattedStatus = 'present';
            } elseif (in_array($lowerStatus, ['absent', 'absence'])) {
                $formattedStatus = 'absent';
            } elseif ($lowerStatus === 'permission') {
                $formattedStatus = 'permission';
            } else {
                $formattedStatus = $statusValue;
            }

            Attendance::updateOrCreate(
                [
                    'teacher_id'      => $teacherId,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'status'          => $formattedStatus,
                    'school_class_id' => $request->school_class_id ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'រក្សាទុកវត្តមានបានជោគជ័យ!');
    }
}
