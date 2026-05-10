<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

// Public routes
Route::get('/', [GuestController::class, 'general'])->name('invitation.general');
Route::get('/undangan/{slug}', [GuestController::class, 'invitation'])->name('invitation.guest');
Route::post('/undangan/{slug}/rsvp', [GuestController::class, 'rsvp'])->name('invitation.rsvp');

// Redirect /admin → /admin/guests (dengan proteksi login)
Route::get('/admin', function () {
    return redirect()->route('admin.guests.index');
})->middleware('admin.auth');

// Admin routes (dilindungi Basic Auth)
Route::prefix('admin')->middleware('admin.auth')->name('admin.')->group(function () {
    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::get('/guests/create', [GuestController::class, 'create'])->name('guests.create');
    Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::get('/guests/{guest}/edit', [GuestController::class, 'edit'])->name('guests.edit');
    Route::put('/guests/{guest}', [GuestController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.destroy');
    Route::post('/guests/bulk', [GuestController::class, 'bulkStore'])->name('guests.bulk');
});