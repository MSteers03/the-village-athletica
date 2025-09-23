<?php

use Illuminate\Support\Facades\Route;


// Maintenance mode routes
Route::get('/maintenance', [App\Http\Controllers\MaintenanceController::class, 'show'])->name('maintenance');
Route::post('/maintenance/contact', [App\Http\Controllers\MaintenanceController::class, 'submitContactForm'])->name('maintenance.contact');

// All other routes - these will be redirected to maintenance mode
Route::get('/{any}', function () {
    return redirect('/maintenance');
})->where('any', '.*');

Route::get('/', function () {
    return view('home');
});

Route::get('/pricing', function () {
    return view('pricing');
});
