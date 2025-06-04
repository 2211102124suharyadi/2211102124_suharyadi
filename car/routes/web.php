<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/logout', function () {
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    Auth::logout();

    return redirect('/');
})->middleware('auth')->name('logout');

// Route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::resource('car', CarController::class);
});

require __DIR__.'/auth.php';
