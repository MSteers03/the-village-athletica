<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckMaintenance;
use App\Http\Controllers\MembershipInquiryController;

// Maintenance mode routes (always accessible)
Route::get('/maintenance', [App\Http\Controllers\MaintenanceController::class, 'show'])->name('maintenance');
Route::post('/maintenance/contact', [App\Http\Controllers\MaintenanceController::class, 'submitContactForm'])->name('maintenance.contact');
Route::post('/membership-inquiry', [MembershipInquiryController::class, 'submit'])->name('membership.inquiry');

// Apply maintenance mode middleware to all other routes
Route::middleware([CheckMaintenance::class])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/pricing', function () {
        return view('pricing');
    })->name('pricing');

    Route::get('/timetable', function () {
        return view('timetable');
    })->name('timetable');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/test', function () {
    return view('test');
    })->name('test');
});