<?php

use App\Http\Controllers\DeskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DBController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------
|                      ROUTES
|--------------------------------------------------
| 
| Still need to change the main route to servifacil.
|
 */

Route::get('/', function () {
    return view('welcome');
});

/**
 * 
 * All the routes are in a group because this way all
 * have to go through the auth middleware without having
 * to type several times the middleware
 * 
 */
Route::middleware('auth')->group(function () {
    /**
     * Profile editing routes 
     */
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /**
     * Main routes
     */
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/notes', [NoteController::class, 'index'])->name('note.index');
    Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('/note/store', [NoteController::class, 'store'])->name('note.store');
    Route::get('/note/edit/{id?}', [NoteController::class, 'edit'])->name('note.edit');
    Route::patch('/note/update/{id?}', [NoteController::class, 'update'])->name('note.update');
    Route::delete('/note/delete/{id?}', [NoteController::class, 'delete'])->name('note.delete');
    

    Route::get('/dishes/{section?}', [DishController::class, 'index'])->name('dishes.index');
    Route::get('/dish/{id?}', [DishController::class, 'show'])->name('dish.show');

    Route::get('mgmt/master', [DBController::class, 'index'])->name('master-mgmt.index');

    Route::get('mgmt/note', [DBController::class, 'note'])->name('note-mgmt.index');

    Route::get('mgmt/desk', [DBController::class, 'desk'])->name('desk-mgmt.index');
    Route::get('mgmt/company', [DBController::class, 'co'])->name('company-mgmt.index');

});

/**
 * Dk what all that is
 */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Auth::routes();