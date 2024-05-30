<?php

use App\Http\Controllers\CoController;
use App\Http\Controllers\Controller;
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
    Route::delete('/note/delete/{id?}', [NoteController::class, 'destroy'])->name('note.delete');


    Route::middleware(['can:create.dish'])->group(function () {
        Route::get('/dish/create', [DishController::class, 'create'])->name('dish.create');
        Route::post('/dish/store', [DishController::class, 'store'])->name('dish.store');
    });
    Route::get('/dishes/{section?}', [DishController::class, 'index'])->name('dishes.index');
    Route::get('/dish/{id?}', [DishController::class, 'show'])->name('dish.show');

    Route::middleware(['can:mgmt.desk'])->group(function () {
        Route::get('/desk/create', [DeskController::class, 'create'])->name('desk.create');
        Route::post('/desk/store', [DeskController::class, 'store'])->name('desk.store');
        Route::delete('/desk/delete/{id?}', [DeskController::class, 'destroy'])->name('desk.delete');
    });

    Route::middleware(['can:admin.all'])->group(function(){
        Route::get('/company/create', [CoController::class, 'create'])->name('co.create');
        Route::post('/company/store', [CoController::class, 'store'])->name('co.store');
        Route::delete('/company/delete/{id?}', [CoController::class, 'destroy'])->name('co.delete');
        Route::get('/company/edit/{id?}', [CoController::class, 'edit'])->name('co.edit');
        Route::get('/company/update/{id?}', [CoController::class, 'update'])->name('co.update');
    });

    Route::get('mgmt/master', [DBController::class, 'index'])->name('master-mgmt.index')->can('admin.all');
    Route::get('mgmt/note', [DBController::class, 'note'])->name('note-mgmt.index');
    Route::get('mgmt/desk', [DBController::class, 'desk'])->name('desk-mgmt.index');
    Route::get('mgmt/company', [DBController::class, 'co'])->name('company-mgmt.index')->can('mgmt.co');
});

require __DIR__ . '/auth.php';

Auth::routes();