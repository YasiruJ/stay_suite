<?php

use App\Http\Controllers\Server\PropertyOwner\PropertyOwnerDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [PropertyOwnerDashboardController::class, 'index']);
Route::get('booking-availability', [PropertyOwnerDashboardController::class, 'showAvailability']);
Route::get('properties/add', [PropertyOwnerDashboardController::class, 'showProperties']);
Route::post('properties/save', [PropertyOwnerDashboardController::class, 'saveProperties']);
Route::get('properties/all', [PropertyOwnerDashboardController::class, 'showAllProperties']);
Route::post('property/status/update/{id}', [PropertyOwnerDashboardController::class, 'updateOwnerPropertyStatus']);

Route::get('properties/edit/{id}', [PropertyOwnerDashboardController::class, 'editProperties']);
Route::post('properties/edit/{id}/update', [PropertyOwnerDashboardController::class, 'updateProperties']);
Route::get('properties/delete/{id}', [PropertyOwnerDashboardController::class, 'deleteProperties']);

Route::get('properties/edit/{id}/room', [PropertyOwnerDashboardController::class, 'showRoom']);
Route::post('properties/edit/{id}/sub_facilities', [PropertyOwnerDashboardController::class, 'showSubFacilities']);
Route::post('properties/edit/{id}/room/save', [PropertyOwnerDashboardController::class, 'saveRoom']);
Route::post('room/status/update/{id}', [PropertyOwnerDashboardController::class, 'updateRoomStatus']);

Route::get('properties/edit/{id}/room/edit/{room_id}', [PropertyOwnerDashboardController::class, 'showUpdateRoom']);
Route::get('properties/edit/{id}/room/delete/{room_id}', [PropertyOwnerDashboardController::class, 'deleteRoom']);
Route::post('properties/edit/{id}/room/edit/{room_id}/update', [PropertyOwnerDashboardController::class, 'updateRoom']);
Route::post('properties/edit/{id}/room/edit/{room_id}/sub_room/save', [PropertyOwnerDashboardController::class, 'saveSubRoom']);
Route::post('properties/edit/{id}/room/edit/{room_id}/unit/save', [PropertyOwnerDashboardController::class, 'saveUnit']);
Route::post('properties/edit/{id}/room/edit/{room_id}/sub_room/update/{sub_room_id}', [PropertyOwnerDashboardController::class, 'UpdateSubRoom']);
Route::post('properties/edit/{id}/room/edit/{room_id}/sub_room/collect_info', [PropertyOwnerDashboardController::class, 'subRoomUpdateCollectInfo']);
Route::get('properties/edit/{id}/room/edit/{room_id}/unit/collect_info/{unit_id}', [PropertyOwnerDashboardController::class, 'unitUpdateCollectInfo']);
Route::post('properties/edit/{id}/room/edit/{room_id}/unit/update/{unit_id}', [PropertyOwnerDashboardController::class, 'updateUnit']);

Route::post('sub_room/status/update/{id}', [PropertyOwnerDashboardController::class, 'updateSubRoomStatus']);

Route::get('properties/edit/{id}/room/edit/{room_id}/sub_room/delete/{sub_room_id}', [PropertyOwnerDashboardController::class, 'deleteSubRoom']);
Route::get('properties/edit/{id}/room/edit/{room_id}/unit/delete/{unit_id}', [PropertyOwnerDashboardController::class, 'deleteUnitRoom']);

Route::get('review/all', [PropertyOwnerDashboardController::class, 'showOwnersProperty']);
Route::get('review/edit/{id}', [PropertyOwnerDashboardController::class, 'showPropertyReview']);
Route::get('review/edit/{id}/response/{review_id}', [PropertyOwnerDashboardController::class, 'showPropertyOwnerResponse']);
Route::post('review/save_response', [PropertyOwnerDashboardController::class, 'saveResponse']);

Route::get('FAQs/properties/all', [PropertyOwnerDashboardController::class, 'showOwnersPropertyFaq']);
Route::get('FAQs/add/{id}', [PropertyOwnerDashboardController::class, 'showAddFaqs']);
Route::get('FAQs/edit/{id}', [PropertyOwnerDashboardController::class, 'showEditFaqs']);
Route::post('FAQs/save', [PropertyOwnerDashboardController::class, 'saveFaqs']);
Route::post('FAQs/update/{id}', [PropertyOwnerDashboardController::class, 'updateFaqs']);
Route::delete('FAQs/delete/{id}', [PropertyOwnerDashboardController::class, 'deleteFaqs']);

Route::get('bookings/all', [PropertyOwnerDashboardController::class, 'showAllBookings']);
Route::get('bookings/details/{id}', [PropertyOwnerDashboardController::class, 'showBookingDetails']);
Route::post('booking/status/update', [PropertyOwnerDashboardController::class, 'updateBookingStatus']);

Route::get('payments/all', [PropertyOwnerDashboardController::class, 'showAlPayments']);
