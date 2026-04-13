<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//autentikasi
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [UserController::class, 'showRegister']);
    Route::post('/register', [UserController::class, 'register'])->name('register.store');
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.store');
});

// halaman khusus - gaboleh masuk halaman User sebelum login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/user', function () {
        return view('dashboard.index');
    })->name('dashboard.user');

    // CRUD Agenda
    Route::resource('agendas', AgendaController::class);

    Route::post('/logout', [UserController::class, 'logout'])->name('logout.user');
});
