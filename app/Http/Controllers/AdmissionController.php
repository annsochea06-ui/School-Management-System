<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Subject;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    // រក្សាទុកទិន្នន័យដែល Submit ចេញពី Contact Form
    public function store(Request $request)
    {
        $request->validate([
            'full_name'  => 'required|string|max:255',
            'gender'     => 'required|string',
            'phone'      => 'required|string|max:20',
            'subject_id' => 'required|exists:subjects,id',
            'message'    => 'nullable|string|max:500',
        ]);

        Admission::create($request->all());

        return redirect()->back()->with('success', 'ចុះឈ្មោះបានជោគជ័យ! ក្រុមការងារនឹងទាក់ទងទៅវិញឆាប់ៗនេះ។');
    }
}