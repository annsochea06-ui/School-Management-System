<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\TuitionFeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\InvoiceController;
use App\Models\Subject;

/*
|--------------------------------------------------------------------------
| Public Routes (នរណាក៏អាចចូលមើល និង Submit Form បានសេរី)
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Pages
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact Page
Route::get('/contact', function () {
    $subjects = Subject::all();
    return view('contact', compact('subjects'));
})->name('contact');

// Submit Form ពី Contact/Admission
Route::post('/admissions', [AdmissionController::class, 'store'])->name('admissions.store');

// Auth Routes (Register / Login / Logout)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Admin Routes (ទាល់តែ Login ហើយជា Admin ទើបចូលបាន)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // School Resources
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('attendance', AttendanceController::class);

    // Subject Routes
    Route::resource('subjects', SubjectController::class);

    // Classes & Class Attendance Routes
    Route::get('/classes', [SchoolClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/{class_code}', [SchoolClassController::class, 'show'])->name('classes.show');
    Route::post('/classes/{class_code}/attendance', [SchoolClassController::class, 'storeAttendance'])->name('classes.attendance.store');

    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');

    // Finance & Invoices
    Route::get('/tuition-fees', [InvoiceController::class, 'index'])->name('tuition-fees.index');
    Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('invoices.store');

    // ⚠️ កែប្រែមកប្រើ InvoiceController
    Route::post('/tuition-fees/{id}/pay-now', [InvoiceController::class, 'payNow'])->name('tuition-fees.pay-now');
    // Other Financials & Timetables
    Route::resource('payrolls', PayrollController::class);
    Route::put('/payrolls/{id}/pay', [PayrollController::class, 'pay'])->name('payrolls.pay');
    Route::resource('timetables', TimetableController::class);

    // Teacher Attendance Routes
    Route::get('/teacher-attendances', [TeacherAttendanceController::class, 'index'])->name('teacher-attendances.index');
    Route::post('/teacher-attendances', [TeacherAttendanceController::class, 'store'])->name('teacher-attendances.store');
});
