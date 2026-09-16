<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validate អ៊ីមែល និង ពាក្យសម្ងាត់
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 2. ផ្ទៀងផ្ទាត់ការ Login
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 3. ពិនិត្យ Role ដើម្បី Redirect ដោយប្រើ route() ផ្ទាល់ (ដក intended() ចេញ)
            if ($user->role === 'admin') {
                return redirect()->route('dashboard')->with('success', 'ស្វាគមន៍លោក Admin!');
            }

            // User ធម្មតារុញទៅទំព័រ Home ដោយផ្ទាល់ មិនឱ្យទាញ URL /dashboard ចាស់មកប្រើឡើយ
            return redirect()->route('home')->with('success', 'ចូលប្រើប្រាស់ជោគជ័យ!');
        }

        return back()->withErrors([
            'email' => 'អ៊ីមែល ឬពាក្យសម្ងាត់មិនត្រឹមត្រូវឡើយ។',
        ])->onlyInput('email');
    }

    /**
     * Logout: រុញទៅ Home Page វិញ និងផ្ញើសារ Success
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'អ្នកបានចាកចេញពីប្រព័ន្ធដោយជោគជ័យ!');
    }
}