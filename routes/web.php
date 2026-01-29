<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    



    // Routes pour les tâches
    Route::get('/taches', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/taches/creer', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/taches', [TaskController::class, 'store'])->name('tasks.store');


});

require __DIR__.'/auth.php';
