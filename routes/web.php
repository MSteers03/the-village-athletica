<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckMaintenance;
use App\Http\Controllers\MembershipInquiryController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\HealthController;

// Maintenance mode routes (always accessible)
Route::get('/maintenance', [App\Http\Controllers\MaintenanceController::class, 'show'])->name('maintenance');
Route::post('/maintenance/contact', [App\Http\Controllers\MaintenanceController::class, 'submitContactForm'])->name('maintenance.contact');

Route::post('/membership-inquiry', [App\Http\Controllers\MembershipInquiryController::class, 'submit'])->name('membership.inquiry');

Route::post('/contact-submit', [ContactFormController::class, 'submit'])->name('contact.submit');

// Uptime monitoring, outside the maintenance group so it reports maintenance
// mode rather than being masked by it.
Route::get('/health', [HealthController::class, 'show'])->name('health');
Route::get('/health/deep', [HealthController::class, 'deep'])->name('health.deep');

Route::get('/sitemap.xml', function () {
    $content = file_get_contents(public_path('sitemap.xml'));
    return response($content, 200)->header('Content-Type', 'application/xml');
});

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

    Route::get('/contact', [ContactFormController::class, 'show'])->name('contact');
});