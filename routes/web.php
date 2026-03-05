<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PraktijkmanagementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AllergenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/praktijkmanagement', [PraktijkmanagementController::class, 'index'])
    ->name('praktijkmanagement.index')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/praktijkmanagement/userroles', [PraktijkmanagementController::class, 'userroles'])
    ->name('praktijkmanagement.userroles')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/praktijkmanagement/{id}/edit', [PraktijkmanagementController::class, 'edit'])
    ->name('praktijkmanagement.edit')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/praktijkmanagement/{id}', [PraktijkmanagementController::class, 'show'])
    ->name('praktijkmanagement.show')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::put('/praktijkmanagement/{id}', [PraktijkmanagementController::class, 'update'])
    ->name('praktijkmanagement.update')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::delete('/praktijkmanagement/{id}', [PraktijkmanagementController::class, 'destroy'])
    ->name('praktijkmanagement.destroy')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Roles Management Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('roles', RoleController::class)->parameters([
        'roles' => 'user'
    ])->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::get('/allergens', [AllergenController::class, 'index'])->name('allergens.index');
    Route::get('/allergens/{product}/supplier', [AllergenController::class, 'supplier'])->name('allergens.supplier');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
