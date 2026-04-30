<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CoverageController;
use App\Http\Controllers\PLIController;
use Illuminate\Support\Facades\Route;
use App\Models\Province;
use App\Models\Coverage;
use App\Models\PLI;
use App\Models\Region;
use App\Models\Division; 

// PUBLIC
Route::get('/', function () {
    return view('welcome');
});


Route::get('/get-provinces/{region}', [CoverageController::class, 'getProvinces']);
//Route::get('/pli/{id}/print', [PLIController::class, 'print'])->name('coverage.print');
Route::get('/coverage/{id}/print', [CoverageController::class, 'print']);
Route::get('/pli/print', [PLIController::class, 'print'])->name('pli.print');

// USER DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// 🔥 ADMIN AREA
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // ✅ KEEP ONLY THIS
    Route::resource('pli', PLIController::class);
    Route::resource('coverage', CoverageController::class);
});

Route::get('/pli/{id}/print', [App\Http\Controllers\CoverageController::class, 'print'])
    ->name('coverage.print');