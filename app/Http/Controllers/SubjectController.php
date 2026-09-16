<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // 1. បង្ហាញ Card Subject ទាំងអស់
    public function index()
    {
        $subjects = Subject::latest()->get();
        return view('subjects.index', compact('subjects'));
    }

    // 2. បង្ហាញទិន្នន័យសិស្សតាម Subject (ប្រើ Route Model Binding ដើម្បីជៀសវាង 404)
    public function show(Subject $subject)
    {
        // Load relationship admissions
        $subject->load('admissions');

        return view('subjects.show', compact('subject'));
    }
}