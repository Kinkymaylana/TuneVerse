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
    $topPicks = [
      ['id'=>1,'title'=>'Orange','artist'=>'Bruno Mars','cover'=>'/covers/orange.jpg'],
      ['id'=>2,'title'=>'Stecu','artist'=>'Fiersa Afran','cover'=>'/covers/stecu.jpg'],
      ['id'=>3,'title'=>'Maito','artist'=>'Out of Joe','cover'=>'/covers/maito.jpg'],
    ];

    $topArtists = [
      ['id'=>1,'name'=>'Bruno Mars','image'=>'/artists/bruno.jpg'],
      ['id'=>2,'name'=>'Ariana Grande','image'=>'/artists/ariana.jpg'],
      // … sesuai Figma
    ];

    return Inertia::render('Home', [
      'topPicks'   => $topPicks,
      'topArtists' => $topArtists,
    ]);
})->name('home');

// Detail lagu
Route::get('/lagu/{id}', function ($id) {
    $song = [
      'id'     => $id,
      'title'  => 'Orange',
      'artist' => 'Bruno Mars',
      'cover'  => '/covers/orange.jpg',
      'lyrics' => '…lirik contoh…',
    ];
    return Inertia::render('LaguDetail', ['song' => $song]);
})->name('lagu.detail');


// Halaman tambah lagu
Route::get('/tambah-lagu', function () {
    return Inertia::render('TambahLagu');
})->name('lagu.create');

