<?php

use App\Http\Controllers\API\ChannelManager\v1\AuthController;
use App\Http\Controllers\API\ChannelManager\v1\AvailabilityController;
use App\Http\Controllers\API\ChannelManager\v1\PropertyController;
use App\Http\Controllers\API\ChannelManager\v1\RoomController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:api', 'role:property-owner']], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::get('refresh-token', [AuthController::class, 'refreshToken']);

        Route::get('property/all', [PropertyController::class, 'getAllProperty']);
        Route::get('property/{property_id}/room/all', [RoomController::class, 'getAllRooms']);

        Route::post('availability/date', [AvailabilityController::class, 'getAvailabilityForDate']);
        Route::post('availability/date_range', [AvailabilityController::class, 'getAvailabilityForDateRange']);
        Route::post('availability/date_range/all/{property_id}', [AvailabilityController::class, 'getAvailabilityForDateRangeAll']);

        Route::post('availability/property/{property_id}/room/{room_id}/room_status', [AvailabilityController::class, 'updateRoomStatus']);
        Route::post('availability/property/{property_id}/room/{room_id}/room_count', [AvailabilityController::class, 'updateRoomCount']);
        Route::post('availability/property/{property_id}/room/{room_id}/sub_room/{sub_room_id}/room_rate', [AvailabilityController::class, 'updateRoomRate']);
    });
});
