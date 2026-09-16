<?php
namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // សំដៅលើ file dashboard.blade.php
    }
}