<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyCheckController;
use App\Http\Controllers\PhotoController;
use App\Livewire\PhotoUpload;
use App\Livewire\PhotoView;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('/navbar', 'navbar');

Route::controller(DailyCheckController::class)
    ->group(function(){
    Route::get('/daily-check/login', 'showLogin')->name('login');
    Route::get('/daily-check/home', 'showHome')->name('home');
    Route::get('/daily-check/report-creating', 'store')->name('store');
});

// Route::controller(PhotoController::class)
//     ->group(function(){
//     Route::get('/daily-check/photos/{photo}/download', 'store')->name('download');
//     Route::get('/daily-check/photos/{photo}', 'show')->name('show');
// });

// livewireComponent
// Route::get('upload', PhotoUpload::class);
Route::get('upload', PhotoView::class);
Route::get('/daily-check/photos/{photo}', PhotoView::class)->name('photo.view');
Route::get('/daily-check/photos/{photo}/show', [PhotoView::class, 'show'])->name('photo.show');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
