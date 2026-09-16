<?php

namespace App\Http\Controllers;
use App\Models\Admission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // នៅក្នុង ContactController.php
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'  => 'required|string|max:255',
            'gender'     => 'required|string',
            'phone'      => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'message'    => 'nullable|string',
        ]);

        Admission::create($validated);

        return redirect()->back()->with('success', 'ចុះឈ្មោះបានជោគជ័យ!');
    }
}
