<?php

use App\Http\Controllers\Server\Booking\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookingController::class, 'index']);
Route::get('/booking_confirm/{booking_id}', [BookingController::class, 'confirmBooking']);
Route::post('/details', [BookingController::class, 'checkBookingDetails']);
Route::post('/sendOtp', [BookingController::class, 'sendOTP']);
Route::post('/verifyOTP', [BookingController::class, 'verifyOTP']);
Route::post('/submit', [BookingController::class, 'submitBookingDetails']);
Route::post('/transaction', [BookingController::class, 'checkTransaction']);
