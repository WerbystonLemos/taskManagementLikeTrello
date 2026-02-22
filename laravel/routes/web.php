<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MoveTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login', 302);
});

Route::get('/projects', function () {
    return view('projects');
})->middleware(['auth', 'verified'])->name('projects');

Route::get("/dashboard/{id}", function ($id) {
    return view('dashboard', ['id' => $id]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/tasks/move', [MoveTaskController::class, 'move'])->name('tasks.move');
});

require __DIR__.'/auth.php';
