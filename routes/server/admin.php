<?php

use App\Http\Controllers\Server\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminDashboardController::class, 'index']);
Route::get('user/login/{id}', [AdminDashboardController::class, 'loginAsUser']);
Route::get('properties/add', [AdminDashboardController::class, 'showAddProperty']);
Route::post('properties/add/save', [AdminDashboardController::class, 'saveProperty']);
Route::get('properties/all', [AdminDashboardController::class, 'showAllProperty']);
Route::post('property/status/update/{id}', [AdminDashboardController::class, 'updatePropertyStatus']);

Route::get('properties/edit/{id}', [AdminDashboardController::class, 'showEditProperty']);
Route::post('properties/edit/{id}/update', [AdminDashboardController::class, 'updateProperty']);
Route::get('properties/delete/{id}', [AdminDashboardController::class, 'deleteProperty']);

Route::get('properties/edit/{id}/room', [AdminDashboardController::class, 'showAddRoom']);
Route::post('properties/edit/{id}/sub_facilities', [AdminDashboardController::class, 'showSubFacilities']);
Route::post('properties/edit/{id}/room/save', [AdminDashboardController::class, 'saveRoom']);

Route::get('properties/edit/{id}/room/edit/{room_id}', [AdminDashboardController::class, 'showUpdateRoom']);

Route::get('properties/edit/{id}/room/delete/{room_id}', [AdminDashboardController::class, 'deleteRoom']);
Route::post('properties/edit/{id}/room/edit/{room_id}/update', [AdminDashboardController::class, 'UpdateRoom']);
Route::post('properties/edit/{id}/room/edit/{room_id}/sub_room/save', [AdminDashboardController::class, 'SaveSubRoom']);
Route::post('properties/edit/{id}/room/edit/{room_id}/unit/save', [AdminDashboardController::class, 'saveUnit']);
Route::post('properties/edit/{id}/room/edit/{room_id}/sub_room/update/{sub_room_id}', [AdminDashboardController::class, 'UpdateSubRoom']);
Route::post('properties/edit/{id}/room/edit/{room_id}/sub_room/collect_info', [AdminDashboardController::class, 'subRoomUpdateCollectInfo']);
Route::get('properties/edit/{id}/room/edit/{room_id}/unit/collect_info/{unit_id}', [AdminDashboardController::class, 'unitUpdateCollectInfo']);
Route::post('properties/edit/{id}/room/edit/{room_id}/unit/update/{unit_id}', [AdminDashboardController::class, 'updateUnit']);
Route::get('properties/edit/{id}/room/edit/{room_id}/sub_room/delete/{sub_room_id}', [AdminDashboardController::class, 'deleteSubRoom']);
Route::get('properties/edit/{id}/room/edit/{room_id}/unit/delete/{unit_id}', [AdminDashboardController::class, 'deleteUnitRoom']);

Route::get('booking/add', [AdminDashboardController::class, 'showAddBooking']);
Route::get('booking/all', [AdminDashboardController::class, 'showAllBooking']);

Route::get('system_settings/locations', [AdminDashboardController::class, 'showLocations']);

Route::post('system_settings/locations/province/save', [AdminDashboardController::class, 'saveProvince']);
Route::delete('system_settings/locations/province/delete/{id}', [AdminDashboardController::class, 'deleteProvince']);
Route::post('system_settings/locations/province/update/{id}', [AdminDashboardController::class, 'updateProvince']);

Route::post('system_settings/locations/district/save', [AdminDashboardController::class, 'saveDistrict']);
Route::delete('system_settings/locations/district/delete/{id}', [AdminDashboardController::class, 'deleteDistrict']);
Route::post('system_settings/locations/district/update/{id}', [AdminDashboardController::class, 'updateDistrict']);

Route::post('system_settings/locations/city/save', [AdminDashboardController::class, 'saveCity']);
Route::delete('system_settings/locations/city/delete/{id}', [AdminDashboardController::class, 'deleteCity']);
Route::post('system_settings/locations/city/update/{id}', [AdminDashboardController::class, 'updateCity']);

Route::get('system_settings/room_facilities', [AdminDashboardController::class, 'showRoomFacilities']);

Route::Post('system_settings/room_facilities/key_facility/save', [AdminDashboardController::class, 'saveKeyFacility']);
Route::post('system_settings/room_facilities/key_facility/update/{id}', [AdminDashboardController::class, 'updateKeyFacilities']);
Route::delete('system_settings/room_facilities/key_facility/delete/{id}', [AdminDashboardController::class, 'deleteKeyFacilities']);

Route::Post('system_settings/room_facilities/facility/save', [AdminDashboardController::class, 'saveRoomFacility']);
Route::post('system_settings/room_facilities/facility/update/{id}', [AdminDashboardController::class, 'updateRoomFacilities']);
Route::delete('system_settings/room_facilities/facility/delete/{id}', [AdminDashboardController::class, 'deleteRoomFacilities']);

Route::Post('system_settings/room_facilities/sub_facility/save', [AdminDashboardController::class, 'saveRoomSubFacilities']);
Route::post('system_settings/room_facilities/sub_facility/update/{id}', [AdminDashboardController::class, 'updateSubFacilities']);
Route::delete('system_settings/room_facilities/sub_facility/delete/{id}', [AdminDashboardController::class, 'deleteSubFacilities']);

Route::get('system_settings/property_facilities', [AdminDashboardController::class, 'showPropertyFacilities']);
Route::post('system_settings/property_facilities/save', [AdminDashboardController::class, 'savePropertyFacility']);
Route::post('system_settings/property_facilities/update/{id}', [AdminDashboardController::class, 'updatePropertyFacilities']);
Route::delete('system_settings/property_facilities/delete/{id}', [AdminDashboardController::class, 'deletePropertyFacilities']);

Route::get('system_settings/room_type', [AdminDashboardController::class, 'showRoomType']);
Route::post('system_settings/room_type/save', [AdminDashboardController::class, 'saveRoomType']);
Route::post('system_settings/room_type/update/{id}', [AdminDashboardController::class, 'updateRoomType']);
Route::delete('system_settings/room_type/delete/{id}', [AdminDashboardController::class, 'deleteRoomType']);

Route::get('system_settings/property_type', [AdminDashboardController::class, 'showPropertyType']);
Route::post('system_settings/property_type/save', [AdminDashboardController::class, 'savePropertyType']);
Route::post('system_settings/property_type/update/{id}', [AdminDashboardController::class, 'updatePropertyType']);
Route::delete('system_settings/property_type/delete/{id}', [AdminDashboardController::class, 'deletePropertyType']);

Route::get('system_settings/bed_type', [AdminDashboardController::class, 'showBedType']);
Route::post('system_settings/bed_type/save', [AdminDashboardController::class, 'saveBedType']);
Route::post('system_settings/bed_type/update/{id}', [AdminDashboardController::class, 'updateBedType']);
Route::delete('system_settings/bed_type/delete/{id}', [AdminDashboardController::class, 'deleteBedType']);

Route::get('system_settings/credit_card_type', [AdminDashboardController::class, 'showCreditCardType']);
Route::post('system_settings/credit_card_type/save', [AdminDashboardController::class, 'saveCreditCardType']);
Route::get('system_settings/credit_card_type/edit/{id}', [AdminDashboardController::class, 'showEditCreditCardType']);
Route::Post('system_settings/credit_card_type/edit/{id}/update', [AdminDashboardController::class, 'updateCreditCardType']);
Route::delete('system_settings/credit_card_type/delete/{id}', [AdminDashboardController::class, 'deleteCreditCardType']);

Route::get('property_owner/add', [AdminDashboardController::class, 'showAddPropertyOwner']);
Route::post('property_owner/add/save', [AdminDashboardController::class, 'savePropertyOwner']);
Route::get('property_owner/all', [AdminDashboardController::class, 'showAllPropertyOwner']);
Route::get('property_owner/edit/{id}', [AdminDashboardController::class, 'showEditPropertyOwner']);
Route::get('property_owner/delete/{id}', [AdminDashboardController::class, 'DeletePropertyOwner']);
Route::post('property_owner/update', [AdminDashboardController::class, 'updatePropertyOwner']);

Route::get('offer/add', [AdminDashboardController::class, 'showAddOffer']);
Route::post('offer/add/save', [AdminDashboardController::class, 'saveOffer']);
Route::get('offer/all', [AdminDashboardController::class, 'showAllOffer']);

Route::get('user_management/property_owner/details', [AdminDashboardController::class, 'showPropertyOwnerDetails']);
Route::post('property_owner/status/update/{id}', [AdminDashboardController::class, 'updatePropertyOwnerStatus']);
// Route::get('/property_owner/edit/{id}', [AdminDashboardController::class, 'showEditPropertyOwnerDetails']);
Route::post('property_owner/edit/{id}/update', [AdminDashboardController::class, 'updatePropertyOwnerDetails']);
Route::get('property_owner/delete/{id}', [AdminDashboardController::class, 'deletePropertyOwnerDetails']);

Route::get('user_management/customer/details', [AdminDashboardController::class, 'showCustomerDetails']);
Route::post('customer/status/update/{id}', [AdminDashboardController::class, 'updateCustomerStatus']);
Route::get('customer/edit/{id}', [AdminDashboardController::class, 'showEditCustomerDetails']);
Route::post('customer/edit/{id}/update', [AdminDashboardController::class, 'updateCustomerDetails']);
Route::get('customer/delete/{id}', [AdminDashboardController::class, 'deleteCustomerDetails']);

Route::get('user_management/call_center/details', [AdminDashboardController::class, 'showCallCenterDetails']);
Route::post('call_center/status/update/{id}', [AdminDashboardController::class, 'updateCallCenterStatus']);
Route::get('call_center/edit/{id}', [AdminDashboardController::class, 'showEditCallCenterDetails']);
Route::post('call_center/edit/{id}/update', [AdminDashboardController::class, 'updateCallCenterDetails']);
Route::get('call_center/delete/{id}', [AdminDashboardController::class, 'deleteCallCenterDetails']);

Route::get('user_management/referral_user/details', [AdminDashboardController::class, 'showReferralUserDetails']);
Route::post('referral_user/status/update/{id}', [AdminDashboardController::class, 'updateReferralUserStatus']);
Route::get('referral_user/edit/{id}', [AdminDashboardController::class, 'showEditReferralUserDetails']);
Route::post('referral_user/edit/{id}/update', [AdminDashboardController::class, 'updateReferralUserDetails']);
Route::get('referral_user/delete/{id}', [AdminDashboardController::class, 'deleteReferralUserDetails']);
