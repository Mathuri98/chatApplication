<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TextController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth'])->group(function () {
    Route::get('/', [ChatController::class, 'index']);
    Route::get('/chats/create', [ChatController::class, 'create']);
     Route::get('/chats/show/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats', [ChatController::class, 'store']);
    Route::post('/logout', [SessionController::class, 'destroy']);
    Route::post('/texts', [TextController::class, 'store']);//creating a new text within a chat 
});


Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');

    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [SessionController::class, 'store']);
});
