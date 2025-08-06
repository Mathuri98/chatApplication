<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::post('/logout', [SessionController::class, 'destroy']);
});
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');

    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [SessionController::class, 'store']);
});



