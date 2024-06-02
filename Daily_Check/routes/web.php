<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyCheckController;
use App\Http\Controllers\PhotoController;
use App\Livewire\DocumentUpload;
use App\Livewire\PhotoUpload;
use App\Livewire\PhotoList;
use App\Livewire\TestCreating;
use App\Livewire\EmployeeRegistration;
use App\Livewire\ReportCreating;
use App\Livewire\ReportDisplay;
use App\Livewire\WorkersCheckList;
use App\Livewire\ScheduleRegistration;
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

// テスト用
Route::get('/daily-check/test-creating', function () {
    return view('/daily-check/test_creating');
});
Route::get('/test', function () {
    return view('test');
});

Route::controller(DailyCheckController::class)
    ->group(function () {
        // Route::get('/daily-check/test-creating', 'testCreate')->name('test.create');
        // Route::post('/daily-check/test-creating', 'testStore')->name('test.store');
        Route::post('/daily-check/test-creating', 'testDateStore')->name('test.dateStore');

        Route::get('/daily-check/manager_page', 'managerPage')->name('manager.page');
        Route::get('/daily-check/site_management', 'siteManagement')->name('site.management');
        Route::post('/daily-check/site_management', 'siteStore')->name('site.store');

        Route::post('/daily-check/report-creating', 'reportStore')->name('report.store');

        Route::get('/daily-check/login', 'showLogin')->name('login');
        Route::get('/daily-check/home', 'showHome')->name('home');
        // Route::get('/daily-check/photos', 'photoView')->name('photoView');
        // Route::get('/daily-check/photos/{photo}', 'showPhoto')->name('showPhoto');
        // Route::get('/daily-check/document', 'index')->name('index');
    });

    // livewireComponent
    // Route::get('upload', PhotoUpload::class);
Route::get('/daily-check/employee_management', EmployeeRegistration::class)->name('employee.management');
Route::get('/daily-check/workers_arrangement', WorkersCheckList::class)->name('workers.arrangement');

Route::get('/livewire/schedule-registration', ScheduleRegistration::class)->name('schedules.create');

Route::get('/daily-check/report-creating', ReportCreating::class)->name('ReportCreating');
Route::get('/daily-check/report-display', ReportDisplay::class)->name('ReportDisplay');

Route::get('/daily-check/document', DocumentUpload::class)->name('documentList');
Route::get('/daily-check/photo', PhotoList::class)->name('photoList');

// Route::get('/daily-check/test', TestCreating::class);
// Route::get('/daily-check/test-creating', TestCreating::class)->name('test');
Route::get('/article', fn () => view('article.index'));


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
