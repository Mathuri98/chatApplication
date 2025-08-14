<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\LlmController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TextController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [SessionController::class, 'destroy']);
    Route::post('/texts', [TextController::class, 'store']); //creating a new text within a chat 
   
});

Route::middleware(['auth'])->controller(ChatController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/chats/create', 'create');
    Route::get('/chats/{chat}/export', 'export');
    Route::get('/chats/show/{chat}', 'show')->name('chats.show');
    Route::post('/chats', 'store');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');

    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [SessionController::class, 'store']);
});
