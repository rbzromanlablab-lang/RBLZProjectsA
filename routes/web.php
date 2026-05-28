<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PSUController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserAccessController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'showLogin'])->middleware('no-cache')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('no-cache')->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['session-auth', 'no-cache'])->name('logout');

Route::middleware(['session-auth', 'no-cache', 'password.changed'])->group(function () {
    Route::get('/dashboard', [UserAccessController::class, 'dashboard'])->name('dashboard');
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.update');
    Route::get('/student/dashboard', [UserAccessController::class, 'studentDashboard'])
        ->middleware('role:student')
        ->name('student.dashboard');
    Route::get('/teacher/dashboard', [UserAccessController::class, 'teacherDashboard'])
        ->middleware('role:teacher')
        ->name('teacher.dashboard');
    Route::get('/admin/dashboard', [UserAccessController::class, 'adminDashboard'])
        ->middleware('role:admin')
        ->name('admin.dashboard');
    Route::post('/admin/users', [UserAccessController::class, 'storeUser'])
        ->middleware('role:admin')
        ->name('admin.users.store');
    Route::post('/admin/teachers', [UserAccessController::class, 'storeTeacher'])
        ->middleware('role:admin')
        ->name('admin.teachers.store');
    Route::get('/admin/teachers', [UserAccessController::class, 'teachers'])
        ->middleware('role:admin')
        ->name('admin.teachers.index');
    Route::get('/admin/teachers/create', [UserAccessController::class, 'createTeacher'])
        ->middleware('role:admin')
        ->name('admin.teachers.create');
    Route::get('/admin/teachers/{teacher}', [UserAccessController::class, 'showTeacher'])
        ->middleware('role:admin')
        ->name('admin.teachers.show');
    Route::get('/admin/teachers/{teacher}/edit', [UserAccessController::class, 'editTeacher'])
        ->middleware('role:admin')
        ->name('admin.teachers.edit');
    Route::put('/admin/teachers/{teacher}', [UserAccessController::class, 'updateTeacher'])
        ->middleware('role:admin')
        ->name('admin.teachers.update');
    Route::delete('/admin/teachers/{teacher}', [UserAccessController::class, 'destroyTeacher'])
        ->middleware('role:admin')
        ->name('admin.teachers.destroy');
});

Route::get('/roms', function () {
    return view('welcome');
})->middleware(['session-auth', 'no-cache', 'password.changed']); 

Route::get('/greetings', function () {
    $name = "Juan";  

    return $name;
})->middleware(['session-auth', 'no-cache', 'password.changed']); 

Route::get('/about', [CalculateController::class, 'about'])->middleware(['session-auth', 'no-cache', 'password.changed']);

Route::get('/greet', [StudentController::class, 'greet'])->middleware(['session-auth', 'no-cache', 'password.changed']);
Route::get('/displayprofile', [StudentController::class, 'displayProfile'])->middleware(['session-auth', 'no-cache', 'password.changed']);
Route::get('/displayDashboard', [StudentController::class, 'displayDashboard'])->middleware(['session-auth', 'no-cache', 'password.changed']);
Route::get('/displayAboutUs', [StudentController::class, 'displayAboutUs'])->middleware(['session-auth', 'no-cache', 'password.changed']);



// Route::get('/about', [PagesController::class, 'about'] );

// Route::get('/welcome', [PSUController::class, 'welcome'] )->name('welcome');
// Route::get('/mission', [PSUController::class, 'mission'])->name('mission');
// Route::get('/vision', [PSUController::class, 'vision'] )->name('vision');
// Route::get('/EOMSPolicy', [PSUController::class, 'EOMSPolicy'] )->name('EOMSPolicy');

// Route::get('/student/{name}/{course}', [PSUController::class, 'student'] )->name('student');



 Route::get('/maintenance' , [PagesController::class, 'maintenance'])->middleware(['session-auth', 'no-cache', 'password.changed']);

Route::resource('/students', StudentController::class)->middleware(['session-auth', 'no-cache', 'password.changed', 'role:admin', 'maintenance']);
Route::resource('/degrees', DegreeController::class)->middleware(['session-auth', 'no-cache', 'password.changed', 'role:admin']);

// Custom routes for navigation pages
Route::get('/profile', function() {
    return view('profile');
})->middleware(['session-auth', 'no-cache', 'password.changed'])->name('profile');

Route::get('/aboutUs', function() {
    return view('aboutUs');
})->middleware(['session-auth', 'no-cache', 'password.changed'])->name('aboutUs');

Route::middleware(['session-auth', 'no-cache', 'password.changed', 'groupMiddleware'])->group(function(){
    
Route::get('/greet', [StudentController::class, 'greet'] );
Route::get('/displayprofile', [StudentController::class, 'displayProfile'] );
Route::get('/displayDashboard', [StudentController::class, 'displayDashboard'] );
Route::get('/displayAboutUs', [StudentController::class, 'displayAboutUs'] );
});
