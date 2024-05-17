<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dishes/{section?}', [\App\Http\Controllers\DishController::class, 'index'])->name('dishes.index');
// Route::get('/user', [ProfileController::class, 'index'])->name('profile.edit');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';

Auth::routes();

