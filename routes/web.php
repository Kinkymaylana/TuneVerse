<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/', fn () => Inertia::render('Home'));
Route::get('/login', fn () => Inertia::render('Auth/Login'))->name('login');
Route::get('/register', fn () => Inertia::render('Auth/Register'))->name('register');
Route::get('/home', fn () => Inertia::render('Home'))->name('home');
Route::get('/create', fn () => Inertia::render('TambahLagu'))->name('create');
Route::get('/music/{id}', fn ($id) => Inertia::render('LaguDetail', ['id' => $id]))->name('music.detail');
Route::get('/profile', fn () => Inertia::render('Profile/Edit'))->name('profile');
