<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Foundation\Application;
// use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Halaman utama menampilkan daftar lagu & artis (sesuai desain beranda TuneVerse)
Route::get('/home', function () {
    return Inertia::render('Home'); // Home.vue
})->name('home');

// Detail lagu
Route::get('/lagu/{id}', function ($id) {
    return Inertia::render('LaguDetail', ['id' => $id]);
});

// Detail artis
Route::get('/artis/{id}', function ($id) {
    return Inertia::render('ArtisDetail', ['id' => $id]);
});

// Halaman tambah lagu
Route::get('/tambah-lagu', function () {
    return Inertia::render('TambahLagu'); // Pastikan kamu sudah buat file TambahLagu.vue di folder resources/js/Pages atau resources/js/Views (sesuaikan dengan struktur project kamu)
})->name('tambah-lagu');

