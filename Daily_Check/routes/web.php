<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyCheckController;
use App\Http\Controllers\PhotoController;
use App\Livewire\DocumentUpload;
use App\Livewire\PhotoUpload;
use App\Livewire\PhotoView;
use App\Livewire\TestCreating;
use App\Livewire\Register;
use App\Livewire\ReportCreating;
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
    Route::get('/daily-check/test-creating', 'testCreate')->name('test.create');
    // Route::post('/daily-check/test-creating', 'testStore')->name('test.store');
    Route::post('/daily-check/test-creating', 'testDateStore')->name('test.dateStore');

    Route::get('/daily-check/site_list_management', 'siteCreate')->name('site.create');
    Route::post('/daily-check/site_list_management', 'siteStore')->name('site.store');

    Route::post('/daily-check/report-creating', 'reportStore')->name('report.store');

    Route::get('/daily-check/login', 'showLogin')->name('login');
    Route::get('/daily-check/home', 'showHome')->name('home');
    // Route::get('/daily-check/photos', 'photoView')->name('photoView');
    Route::get('/daily-check/photos/{photo}', 'showPhoto')->name('showPhoto');
    // Route::get('/daily-check/document', 'index')->name('index');
});

// livewireComponent
// Route::get('upload', PhotoUpload::class);
Route::get('/daily-check/register', Register::class)->name('register');
Route::get('/daily-check/report-creating', ReportCreating::class)->name('ReportCreating');

Route::get('/daily-check/document', DocumentUpload::class)->name('document');
Route::get('/daily-check/photos', PhotoView::class)->name('photo');

// Route::get('/daily-check/test', TestCreating::class);
// Route::get('/daily-check/test-creating', TestCreating::class)->name('test');
Route::get('/article', fn () => view('article.index'));


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
