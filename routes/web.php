<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ReportController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
*/
Route::middleware('auth')->group(function () {
Route::post('/form/post', [FormController::class, 'store'])->name('form-store');
Route::get('/excel/debug', [FormController::class, 'index'])->name('sheet-debug');
Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/report/view/{id}', [ReportController::class, 'ViewReport'])->name('view-report');
Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/report/search', [ReportController::class, 'search'])->name('search-report');

});

Route::middleware(['auth', 'CheckRole:admin'])->group(function () {

    Route::POST('/report/manage/{id}/{status}', [ReportController::class, 'ManageReport'])->name('manage-report');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/contact/list', [ContactController::class, 'index'])->name('contact');
    Route::get('/contact/get', [ContactController::class, 'GetContact'])->name('contact-get');
    Route::POST('/contact/store', [ContactController::class, 'AddContact'])->name('contact.store');
    Route::delete('/contact/delete/{id}', [ContactController::class, 'DeleteContact'])->name('contact.destroy');
    Route::POST('/contact/update/{id}', [ContactController::class, 'EditContact'])->name('contact.update');
});

require __DIR__.'/auth.php';
