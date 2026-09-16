<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. ប្រសិនបើ User មិនទាន់ Login (Guest)
        if (!Auth::check()) {
            return redirect()->route('home')->with('warning', 'សូមធ្វើការ Login ជាមុនសិន ទើបអាចចូលប្រើប្រាស់ Dashboard បាន!');
        }

        // 2. ប្រសិនបើ Login រួចហើយ តែមិនមែនជា Admin
        if (Auth::user()->role !== 'admin') { // (កែតម្រូវតាម Field Role របស់អ្នក)
            return redirect()->route('home')->with('warning', 'អ្នកគ្មានសិទ្ធិចូលប្រើប្រាស់ទំព័រនេះទេ!');
        }

        return $next($request);
    }
}