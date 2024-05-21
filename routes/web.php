<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * ---------------------------------------------------
 *                      ROUTES
 * ---------------------------------------------------
 * 
 * Still need to change the main route to servifacil.
 * 
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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/cook', [\App\Http\Controllers\CookController::class, 'index'])->name('cook.index');
    Route::get('/dishes/{id?}', [\App\Http\Controllers\DishController::class, 'show'])->name('dish.show');
    Route::get('/dishes/{section?}', [\App\Http\Controllers\DishController::class, 'index'])->name('dishes.index');

});

/**
 * Dk what all that is
 */
require __DIR__ . '/auth.php';

Auth::routes();