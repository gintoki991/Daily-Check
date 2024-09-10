<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DailyCheckController;
use App\Http\Controllers\PhotoController;
use App\Livewire\DocumentUpload;
use App\Livewire\DocumentListManagement;
use App\Livewire\PhotoUpload;
use App\Livewire\PhotoList;
use App\Livewire\PhotoListManagement;
use App\Livewire\EmployeeRegistration;
use App\Livewire\ReportCreating;
use App\Livewire\ReportEditing;
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

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});
Route::post('/logout', [DailyCheckController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DailyCheckController::class, 'index'])->middleware('auth');

// Route::view('/', 'welcome');
Route::get('/', function () {
    return redirect('/login');
});

Route::view('/navbar', 'navbar');

Route::controller(DailyCheckController::class)
    ->group(function () {
        Route::get('/daily-check/manager_page', 'managerPage')->name('manager.page');
        Route::get('/daily-check/site_management', 'siteManagement')->name('site.management');
        Route::post('/daily-check/site_management', 'siteStore')->name('site.store');
        Route::post('/daily-check/report-creating', 'reportStore')->name('report.store');
        Route::get('/daily-check/login', 'showLogin')->name('login');
        Route::get('/daily-check/home', 'showHome')->name('home');
    });

// livewireComponent
Route::get('/daily-check/employee_management', EmployeeRegistration::class)->name('employee.management');
Route::get('/daily-check/workers_arrangement', WorkersCheckList::class)->name('workers.arrangement');
Route::get('/livewire/schedule-registration', ScheduleRegistration::class)->name('schedules.create');
Route::get('/daily-check/report-creating', ReportCreating::class)->name('ReportCreating');
Route::get('/daily-check/reports/{reportId}/edit', [DailyCheckController::class, 'edit'])->name('ReportEditing');
Route::get('/daily-check/report-display', ReportDisplay::class)->name('ReportDisplay');
Route::get('/daily-check/document', DocumentUpload::class)->name('documentList');
Route::get('/daily-check/document-list-management', DocumentListManagement::class)->name('documentListManagement');
Route::get('/daily-check/photo', PhotoList::class)->name('photoList');
Route::get('/daily-check/photo-list-management', PhotoListManagement::class)->name('photoListManagement');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
