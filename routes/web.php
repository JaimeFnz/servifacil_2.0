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
    Route::get('/dishes/{section?}', [DishController::class, 'index'])->name('dishes.index');
    Route::get('/dish/{id?}', [DishController::class, 'show'])->name('dish.show');

    Route::get('/master-mgmt', [DBController::class, 'index'])->name('master-mgmt.index');
    Route::get('/note-mgmt', [DBController::class, 'note'])->name('note-mgmt.index');
    Route::get('/desk-mgmt', [DBController::class, 'desk'])->name('desk-mgmt.index');
    Route::get('/company-mgmt', [DBController::class, 'co'])->name('company-mgmt.index');

});

/**
 * Dk what all that is
 */
require __DIR__ . '/auth.php';

Auth::routes();