<?php

use App\Http\Controllers\ChatUsersController;
use App\Livewire\Chat;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('chat', [ChatUsersController::class, 'index' ])->middleware(['auth'])->name('chat-dashboard');
Route::get('/chat/{user}', Chat::class)->middleware(['auth'])->name('chat');

require __DIR__.'/auth.php';
