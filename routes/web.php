<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

// 1) Redirect root (/) ke /home
Route::get('/', function () {
    return redirect()->route('home');
});

// LOGIN
Route::post('/api/login', [AuthController::class, 'login']);

// REGISTER
Route::post('/api/register', [AuthController::class, 'register']);

// 2) Halaman utama TuneVerse: daftar lagu & artis
Route::get('/home', function () {
    return Inertia::render('Home');
})->name('home');

// 3) Halaman detail lagu (kirim id sebagai prop ke LaguDetail.vue)
Route::get('/music/{id}', function ($id) {
    return Inertia::render('LaguDetail', [
        'id' => $id,
    ]);
})->name('music.detail');

// 4) Dashboard — hanya untuk user yang sudah login & verified
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 5) Profile (edit/update/destroy) — butuh login
Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 6) Semua route auth (login/register/forgot-password) dari Breeze
require __DIR__.'/auth.php';
