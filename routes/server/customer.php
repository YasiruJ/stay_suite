<?php

use App\Http\Controllers\Server\Customer\CustomerDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [CustomerDashboardController::class, 'index']);
Route::get('my_profile', [CustomerDashboardController::class, 'showMyProfile']);
Route::post('my_profile/edit/{id}', [CustomerDashboardController::class, 'editMyProfile']);
Route::get('my_booking', [CustomerDashboardController::class, 'showMyBooking']);
Route::get('bookmark_list', [CustomerDashboardController::class, 'ShowSavedItems']);
Route::get('change_password', [CustomerDashboardController::class, 'showChangePassword']);
