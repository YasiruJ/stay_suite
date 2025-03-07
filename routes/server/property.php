<?php

use App\Http\Controllers\Server\Booking\BookingController;
use App\Http\Controllers\Server\Property\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('list/all', [PropertyController::class, 'showPropertyList'])->name('home.properties');
Route::get('booking', [BookingController::class, 'index']);

Route::get('details/{id}', [PropertyController::class, 'showPropertyDetails']);
Route::get('details/{id}/availability', [PropertyController::class, 'checkAvailability']);

Route::get('list/all/filter', [PropertyController::class, 'searchProperties']);
// Route::post('/availability', [PropertyController::class, 'checkAvailability']);
Route::group(['middleware' => ['role:customer']], function () {
    Route::get('details/{id}/validate_booking_id', [PropertyController::class, 'showBookingLogin']);
    Route::post('details/add_review', [PropertyController::class, 'showAddReviews']);
    Route::post('details/save_review', [PropertyController::class, 'saveReviews']);
});
