<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Employee CRUD (protected)
Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class)->except(['show']);
});

// Public application form
Route::get('/apply', [ApplicationController::class, 'createForm'])->name('applications.create');
Route::post('/apply', [ApplicationController::class, 'store'])->name('applications.store');

// Admin review routes (require role:admin via spatie, but controller checks too)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::post('applications/{application}/approve', [ApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
});

require __DIR__.'/auth.php';
