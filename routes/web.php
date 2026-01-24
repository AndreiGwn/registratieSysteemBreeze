<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TandartsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MondhygienistController;
use App\Http\Controllers\AssistentController;
use App\Http\Controllers\PraktijkmanagementController;
use App\Http\Controllers\LeverancierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/tandarts', [TandartsController::class, 'index'])
    ->name('tandarts.index')
    ->middleware(['auth', 'role:tandarts,praktijkmanagement']);

Route::get('/patient', [PatientController::class, 'index'])
    ->name('patient.index')
    ->middleware(['auth', 'role:patient,praktijkmanagement']);

Route::get('/mondhygienist', [MondhygienistController::class, 'index'])
    ->name('mondhygienist.index')
    ->middleware(['auth', 'role:mondhygienist']);

Route::get('/assistent', [AssistentController::class, 'index'])
    ->name('assistent.index')
    ->middleware(['auth', 'role:assistent']);

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

// Leverancier Routes - Manager Only
Route::get('/leveranciers', [LeverancierController::class, 'index'])
    ->name('leveranciers.index')
    ->middleware(['auth', 'role:manager,praktijkmanagement']);

Route::get('/leveranciers/{id}', [LeverancierController::class, 'show'])
    ->name('leveranciers.show')
    ->middleware(['auth', 'role:manager,praktijkmanagement']);

Route::get('/leveranciers/{id}/edit', [LeverancierController::class, 'edit'])
    ->name('leveranciers.edit')
    ->middleware(['auth', 'role:manager,praktijkmanagement']);

Route::put('/leveranciers/{id}', [LeverancierController::class, 'update'])
    ->name('leveranciers.update')
    ->middleware(['auth', 'role:manager,praktijkmanagement']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
