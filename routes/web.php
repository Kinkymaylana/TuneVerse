<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

// ⛳ Redirect root ke home
Route::get('/', fn () => Inertia::render('Home'));

// 🔐 Auth Pages (Login & Register)
Route::get('/login', fn () => Inertia::render('Auth/Login'))->name('login');
Route::get('/register', fn () => Inertia::render('Auth/Register'))->name('register');

// 🏠 Halaman Home (Landing Page)
Route::get('/home', fn () => Inertia::render('Home'))->name('home');

// ➕ Halaman Tambah Lagu
Route::get('/music/create', function () {
  return Inertia::render('TambahLagu');
})->name('music.create');


/**
 * 📄 Halaman Detail Lagu berdasarkan ID
 * Route ini akan menerima param {id} dan mengirim ke LaguDetail.vue sebagai prop
 */
Route::get('/music/{id}', fn ($id) => Inertia::render('LaguDetail', ['id' => $id]))->name('music.detail');

// 👤 Halaman Edit Profile
Route::get('/profile', fn () => Inertia::render('Profile/Edit'))->name('profile');
