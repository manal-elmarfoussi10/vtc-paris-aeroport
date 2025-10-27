<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\CustomerAdminController;
use App\Http\Controllers\Admin\VehicleAdminController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\Customer\CustomerDashboardController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
// Home
Route::view('/', 'home.index')->name('home');

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::get('/airports', [AirportController::class, 'index'])->name('airports.index');
Route::get('/airports/{slug}', [AirportController::class, 'show'])->name('airports.show');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Authenticated Users
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // General dashboard (redirects based on role)
    Route::get('/dashboard', function () {
        $user = auth()->user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            default => redirect()->route('home'),
        };
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Panel
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->middleware('can:isAdmin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/bookings', BookingAdminController::class);
        Route::get('/bookings-export', [BookingAdminController::class, 'export'])->name('bookings.export');
        Route::resource('/customers', CustomerAdminController::class);
        Route::resource('/vehicles', VehicleAdminController::class);
        Route::patch('/vehicles/{vehicle}/toggle-active', [VehicleAdminController::class, 'toggleActive'])->name('vehicles.toggle-active');
        Route::resource('/contact-messages', ContactMessageAdminController::class)->names([
            'index' => 'contact-messages.index',
            'show' => 'contact-messages.show',
            'destroy' => 'contact-messages.destroy',
        ]);
        Route::get('/calendar', [AdminDashboardController::class, 'calendar'])->name('calendar');
        Route::get('/settings', [SettingAdminController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingAdminController::class, 'update'])->name('settings.update');
        Route::post('/settings/reset', [SettingAdminController::class, 'reset'])->name('settings.reset');
        // API routes for calendar
        Route::get('/api/vehicles', [VehicleAdminController::class, 'apiIndex']);
        Route::get('/api/bookings/{booking}', [BookingAdminController::class, 'apiShow']);    });

    /*
    |--------------------------------------------------------------------------
    | Customer Portal
    |--------------------------------------------------------------------------
    */
    Route::prefix('me')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/bookings', [CustomerDashboardController::class, 'bookings'])->name('bookings');
        Route::get('/bookings/{id}', [CustomerDashboardController::class, 'show'])->name('bookings.show');
        Route::post('/bookings/{id}/cancel', [CustomerDashboardController::class, 'cancel'])->name('bookings.cancel');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});

/*
|--------------------------------------------------------------------------
| Authentication (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';