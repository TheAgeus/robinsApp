<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/', function () {           
    if(auth()->check()) { return redirect('dashboard'); }
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {  
    return view('dashboard');
});

# Auth functionality
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');