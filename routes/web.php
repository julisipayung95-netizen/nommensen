<?php

use App\Http\Controllers\LandingpageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Frontend Website B University
|--------------------------------------------------------------------------
*/

Route::get('/',           [LandingpageController::class, 'index'])->name('home');
Route::get('/profil',     [LandingpageController::class, 'profile'])->name('profile');
Route::get('/dosen',      [LandingpageController::class, 'lectures'])->name('lectures');
Route::get('/mahasiswa',  [LandingpageController::class, 'students'])->name('students');
Route::get('/pengumuman', [LandingpageController::class, 'announcements'])->name('announcements');
Route::get('/berita',     [LandingpageController::class, 'news'])->name('news');