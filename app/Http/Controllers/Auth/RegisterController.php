<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validation ធូរស្រាលបំផុត
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // 2. រក្សាទុកក្នុង DB (ដាក់ fallback 'user' ការពារក្រែងអត់មាន role)
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role ?? 'user',
        ]);

        // 3. Force Redirect ទៅ Login ភ្លាមៗ
        return redirect('/login')->with('success', 'ចុះឈ្មោះជោគជ័យ! សូម Login');
    }
}