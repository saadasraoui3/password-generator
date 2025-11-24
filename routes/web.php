<?php

use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [PasswordController::class, 'index'])->name('password.index');
Route::post('/generate', [PasswordController::class, 'generate'])->name('password.generate');
Route::get('/secure-password', [PasswordController::class, 'secure'])->name('secure.index');
Route::post('/secure-password', [PasswordController::class, 'securePassword'])->name('secure.process');
