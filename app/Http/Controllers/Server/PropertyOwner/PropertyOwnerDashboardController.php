<?php

namespace App\Http\Controllers\Server\PropertyOwner;

use App\Enums\BookingPaymentType;
use App\Enums\BookingStatusType;
use App\Enums\RoleType;
use App\Http\Controllers\Controller;
use App\Models\BedType;
use App\Models\Booking;
use App\Models\BookingHasSubroom;
use App\Models\BookingStatus;
use App\Models\City;
use App\Models\CreditCard;
use App\Models\District;
use App\Models\MealsType;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Models\PropertyHasCreditCard;
use App\Models\PropertyHasFacility;
use App\Models\PropertyHasFaq;
use App\Models\PropertyHasReviewCategory;
use App\Models\PropertyImage;
use App\Models\PropertyReview;
use App\Models\PropertyType;
use App\Models\ReservationPolicy;
use App\Models\ReviewCategory;
use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomHasFacility;
use App\Models\RoomHasSubFacilities;
use App\Models\RoomHasUnit;
use App\Models\RoomImage;
use App\Models\RoomSubFacilities;
use App\Models\RoomType;
use App\Models\SubRoomHasMealsType;
use App\Models\SubRoomHasReservationPolicy;
use App\Models\SubRooms;
use App\Models\Unit;
use App\Models\UnitHasBedType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PropertyOwnerDashboardController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $property_ids = Property::where('user_id', $user_id)->pluck('id');
        $confirm_status = BookingStatus::where('type', BookingStatusType::CONFIRMED)->first();

        $all_bookings_count = 0;
        $active_bookings_count = 0;

        $all_bookings_count = Booking::whereIn('property_id', $property_ids)->count();
        $active_bookings_count = Booking::whereIn('property_id', $property_ids)->where('status_id', $confirm_status->id)->count();
        // dd($active_bookings_count);

        //payments calculation
        $booking_statuses = BookingStatus::whereIn('type', [BookingStatusType::CONFIRMED, BookingStatusType::BOOKING_DONE, BookingStatusType::PAYMENT_SETTLED])->pluck('id');
        // dd($booking_statuses);
        $credit_bookings = Booking::with('bookingStatus')->whereIn('property_id', $property_ids)
            ->where('payment_type', BookingPaymentType::PAY_AT_LOCATION)->whereIn('status_id', $booking_statuses)->get();

        $debit_bookings = Booking::with('bookingStatus')->whereIn('property_id', $property_ids)
            ->where('payment_type', BookingPaymentType::ONLINE)->whereIn('status_id', $booking_statuses)->get();

        // dd($debit_bookings);

        $credit_total = 0;
        $debit_total = 0;

        foreach ($credit_bookings as $key => $booking) {
            if ($booking->bookingStatus->type != 'payment-settled') {
                $credit_total = $credit_total + $booking->gimanhal_fee;
            }
        }

        foreach ($debit_bookings as $key => $booking) {
            if ($booking->bookingStatus->type != 'payment-settled') {
                $debit_total = $debit_total + $booking->property_owner_fee;
            }
        }

        $latest_bookings = Booking::whereIn('property_id', $property_ids)->paginate(10);

        return view('account.propertyOwner.dashboard', [
            'all_bookings_count' => $all_bookings_count, 'active_bookings_count' => $active_bookings_count,
            'credit_total' => $credit_total, 'debit_total' => $debit_total, 'latest_bookings' => $latest_bookings,
        ]);
    }

    public function showAvailability()
    {
        $user_id = auth()->user()->id;
        $properties = Property::where('user_id', $user_id)->get();

        return view('account.propertyOwner.availability', ['properties' => $properties]);
    }

    public function showProperties()
    {
        $property_facility = PropertyFacility::all();
        $district = District::all();
        $city = City::all();
        $property_type = PropertyType::all();
        $credit_card = CreditCard::all();

        return view('account.propertyOwner.properties.add', [
            'cities' => $city, 'districts' => $district,
            'property_facilities' => $property_facility, 'property_types' => $property_type, 'credit_cards' => $credit_card,
        ]);
    }

    public function saveProperties(Request $request)
    {
        $name = $request->input('property_name');
        $user_id = auth()->user()->id;
        $property_type_id = $request->input('property_type_id');
        $description = $request->input('description');
        $district_id = $request->input('district_id');
        $city_id = $request->input('city_id');
        $address = $request->input('address');
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $property_image = $request->file('input_img');
        $property_facilities = $request->input('property_facility');
        $check_in_start_time = $request->input('timepicker_in_start');
        $check_in_end_time = $request->input('timepicker_in_end');
        $check_out_start_time = $request->input('timepicker_out_start');
        $check_out_end_time = $request->input('timepicker_out_end');
        $pet_allowed_status = $request->input('pet_allowed');
        $credit_card_types = $request->input('card_type');
        $age_restriction = $request->input('age_restriction');

        $property = new Property;

        $property->name = $name;
        $property->user_id = $user_id;
        $property->property_type_id = $property_type_id;
        $property->description = $description;
        $property->district_id = $district_id;
        $property->city_id = $city_id;
        $property->address = $address;
        $property->longitude = $longitude;
        $property->latitude = $latitude;
        $property->check_in_start_time = $check_in_start_time;
        $property->check_in_end_time = $check_in_end_time;
        $property->check_out_start_time = $check_out_start_time;
        $property->check_out_end_time = $check_out_end_time;
        $property->pet_allowed = $pet_allowed_status;
        $property->age_restriction = $age_restriction;

        if (!empty($property_image)) {
            $file_ex = strtolower(File::extension($property_image->getClientOriginalName()));
            //  dd( $file_ex );
            if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif' && $file_ex != 'pdf') {
                $res['success'] = false;
                $res['message'] = 'Invalid photo type!';

                return response($res);
            }

            $filename = uniqid() . '.' . $file_ex;
            $property_image->storeAs('public/property_image', $filename);
            $property->main_image = $filename;
        } else {
            $property->main_image = null;
        }
        $property->save();

        $property_id = $property->id;

        if ($request->hasfile('sub_images')) {
            foreach ($request->sub_images as $sub_image) {
                $file_ex = strtolower(File::extension($sub_image->getClientOriginalName()));

                if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif') {
                    $res['success'] = false;
                    $res['message'] = 'Invalid photo type!';

                    return response($res);
                }

                //dump($sub_image);

                $filename = uniqid() . '.' . $file_ex;
                $sub_image->storeAs('public/property_image/property_sub_images', $filename);

                $property_image = new PropertyImage;

                $property_image->property_id = $property_id;
                $property_image->name = $filename;
                $property_image->save();
            }
        }

        foreach ($property_facilities as $property_facility) {
            DB::table('property_has_facilities')->insert([
                'property_id' => $property_id,
                'property_facility_id' => $property_facility,
            ]);
        }

        // foreach ($credit_card_types as $credit_card_type) {
        //     DB::table('property_has_credit_cards')->insert([
        //         'property_id' => $property_id,
        //         'credit_card_id' => $credit_card_type,
        //     ]);
        // }

        $review_categories = ReviewCategory::all();

        foreach ($review_categories as $review_category) {
            $property_has_review_category = new PropertyHasReviewCategory;
            $property_has_review_category->property_id = $property_id;
            $property_has_review_category->review_category_id = $review_category->id;
            $property_has_review_category->save();
        }

        $res['success'] = true;
        $res['message'] = 'property Added successfully!';

        return response($res);
    }

    public function showAllProperties()
    {
        $property = Property::with('user')->get();

        return view('account.propertyOwner.properties.all', ['properties' => $property]);
    }

    public function updateOwnerPropertyStatus(Request $request, $property_id)
    {
        $property = Property::find($property_id);
        $property->property_active = $request->boolean('switchStatus');
        $property->save();

        $res['success'] = true;
        $res['message'] = 'property Status Updated successfully!';

        return response($res);
    }

    public function editProperties($property_id)
    {
        $user = User::role(RoleType::PROPERTY_OWNER)->get();
        $property = Property::find($property_id);
        $district = District::all();
        $city = City::all();
        $room = Room::all()->where('property_id', '=', $property_id);
        $property_facility = PropertyFacility::all();
        $property_has_facility = $property->facilities->pluck('id')->toArray();
        $property_type = PropertyType::all();
        $credit_card = CreditCard::all();
        $property_has_credit_card = $property->creditCards->pluck('id')->toArray();
        //dd($property_has_credit_card);

        return view('account.propertyOwner.properties.edit', [
            'properties' => $property, 'rooms' => $room, 'districts' => $district,
            'cities' => $city, 'users' => $user, 'property_facilities' => $property_facility,
            'property_has_facilities' => $property_has_facility, 'property_types' => $property_type,
            'credit_cards' => $credit_card, 'property_has_credit_cards' => $property_has_credit_card,
        ]);
    }

    public function updateProperties(Request $request, $property_id)
    {
        //  dd(  $request->all());
        $main_image = $request->file('input_img');

        $property = Property::find($property_id);

        $property->user_id = $request->input('user_id');
        $property->name = $request->input('property_name');
        $property->description = $request->input('description');
        $property->address = $request->input('address');
        $property->district_id = $request->input('district_id');
        $property->city_id = $request->input('city_id');
        $property->longitude = $request->input('longtitude');
        $property->latitude = $request->input('latititude');
        $property->check_in_start_time = $request->input('timepicker_in_start');
        $property->check_in_end_time = $request->input('timepicker_in_end');
        $property->check_out_start_time = $request->input('timepicker_out_start');
        $property->check_out_end_time = $request->input('timepicker_out_end');
        $property->pet_allowed = $request->input('pet_allowed');
        $property->age_restriction = $request->input('age_restriction');
        $property_facilities = $request->input('Property_facility');
        $credit_card_types = $request->input('card_type');

        if (!empty($main_image)) {
            $file_ex = strtolower(File::extension($main_image->getClientOriginalName()));
            //  dd( $file_ex );
            if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif' && $file_ex != 'pdf') {
                $res['success'] = false;
                $res['message'] = 'Invalid photo type!';

                return response($res);
            }

            $filename = uniqid() . '.' . $file_ex;
            $main_image->storeAs('public/property_image', $filename);
            $property->main_image = $filename;
        } else {
            $property->main_image = null;
        }

        $property->save();

        $property_id = $property_id;

        if ($request->hasfile('sub_images')) {
            foreach ($request->sub_images as $sub_image) {
                $file_ex = strtolower(File::extension($sub_image->getClientOriginalName()));

                if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif') {
                    $res['success'] = false;
                    $res['message'] = 'Invalid photo type!';

                    return response($res);
                }

                $filename = uniqid() . '.' . $file_ex;
                $sub_image->storeAs('public/property_image/property_sub_images', $filename);

                $property_image = new PropertyImage;

                $property_image->property_id = $property_id;
                $property_image->name = $filename;
                $property_image->save();
            }
        }

        $property_has_facilites = PropertyHasFacility::where('property_id', $property_id)->get();
        $existing_property_facility_id_list = [];

        foreach ($property_has_facilites as $property_has_facility) {
            array_push($existing_property_facility_id_list, "{$property_has_facility->property_facility_id}");
        }

        $to_add = array_diff($property_facilities, $existing_property_facility_id_list);

        foreach ($to_add as $a) {
            $property_has_facilites = new PropertyHasFacility;
            $property_has_facilites->property_id = $property_id;
            $property_has_facilites->property_facility_id = $a;
            $property_has_facilites->save();
        }

        $to_delete = array_diff($existing_property_facility_id_list, $property_facilities);

        foreach ($to_delete as $a) {
            PropertyHasFacility::where('property_id', $property_id)->where('property_facility_id', $a)->delete();
        }

        $property_has_credit_cards = PropertyHasCreditCard::where('property_id', $property_id)->get();
        $existing_property_credit_card_id_list = [];

        foreach ($property_has_credit_cards as $property_has_credit_card) {
            array_push($existing_property_credit_card_id_list, "{$property_has_credit_card->credit_card_id}");
        }

        $to_add_cards = array_diff($credit_card_types, $existing_property_credit_card_id_list);

        // foreach ($to_add_cards as $to_add_card) {
        //     $property_has_credit_cards = new PropertyHasCreditCard;
        //     $property_has_credit_cards->property_id = $property_id;
        //     $property_has_credit_cards->credit_card_id = $to_add_card;
        //     $property_has_credit_cards->save();
        // }

        $to_delete_cards = array_diff($existing_property_credit_card_id_list, $credit_card_types);

        foreach ($to_delete_cards as $to_delete_card) {
            PropertyHasCreditCard::where('property_id', $property_id)->where('credit_card_id', $to_delete_card)->delete();
        }

        $res['success'] = true;
        $res['message'] = 'property Updated successfully!';

        return response($res);
    }

    public function deleteProperties($property_id)
    {
        $property = Property::find($property_id);
        $property->delete();

        return redirect('property-owner/properties/all');
    }

    public function showRoom($property_id)
    {
        $items = [];
        $property = Property::find($property_id);
        $facility = RoomFacility::all();
        $room_type = RoomType::all();

        return view('account.propertyOwner.rooms.add', ['properties' => $property, 'room_types' => $room_type, 'facility' => $facility]);
    }

    public function showSubFacilities(Request $request)
    {
        //   dd($facility);
        $facility_id = $request->input('property_facility_id');
        //dd($facility_id);
        $facility_id_array = explode(',', $facility_id);
        //dd($facility_id_array);
        for ($i = 0; $i < count($facility_id_array); $i++) {
            //dump($facility_id_array[$i]);
            $new_facility_id = $facility_id_array[$i];
            $items[] = RoomSubFacilities::where('facility_id', $new_facility_id)->get();
            //dd($items);
        }
        //  dd($cars);

        $sub_facilities = RoomSubFacilities::where('facility_id', $facility_id)->get();
        // dd($sub_facilities);

        return response()->json($items);
    }

    public function saveRoom(Request $request, $property_id)
    {
        $room = new Room;

        $facility_id_array = $request->input('property_facility_id');
        $sub_facilities_array = $request->input('sub_facilities');
        $room_type_id = $request->input('room_type_id');
        $room_title = $request->input('room_title');
        $room_count = $request->input('room_count');
        // $occupancy = $request->input('occupancy');
        // $room_rate = $request->input('rate');
        // $no_of_room = $request->input('no_of_room');
        $room_size = $request->input('room_size');
        $room_description = $request->input('description');

        $room->type_id = $room_type_id;
        $room->title = $room_title;
        $room->room_count = $room_count;
        $room->description = $room_description;
        $room->room_size = $room_size;
        // $room->occupancy = $occupancy;
        // $room->no_of_rooms = $no_of_room;
        // $room->rate = $room_rate;
        $room->property_id = $property_id;

        $room->save();

        for ($i = 0; $i < count($facility_id_array); $i++) {
            $facility_id = $facility_id_array[$i];
            $room_has_facility = new RoomHasFacility;
            $room_has_facility->room_id = $room->id;
            $room_has_facility->facility_id = $facility_id;
            $room_has_facility->save();
        }
        for ($i = 0; $i < count($sub_facilities_array); $i++) {
            $sub_facilities_id = $sub_facilities_array[$i];
            $room_has_sub_facility = new RoomHasSubFacilities;

            $room_has_sub_facility->sub_facility_id = $sub_facilities_id;
            $room_has_sub_facility->room_id = $room->id;
            $room_has_sub_facility->save();

            //$sub_facility = RoomSubFacilities::find($sub_facilities_id);
            //dump($sub_facility->facility_id);
            //$room_has_sub_facility->facility_id = $sub_facility->facility_id;
        }

        $room_id = $room->id;

        if ($request->hasfile('sub_images')) {
            foreach ($request->sub_images as $sub_image) {
                $file_e = File::extension($sub_image->getClientOriginalName());
                $file_ex = strtolower(File::extension($sub_image->getClientOriginalName()));

                if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif') {
                    $res['success'] = false;
                    $res['message'] = 'Invalid photo type!';

                    return response($res);
                }

                ///dump($sub_image);

                $filename = uniqid() . '.' . $file_ex;
                $sub_image->storeAs('public/room_image/room_sub_images', $filename);

                $room_image = new RoomImage;

                $room_image->room_id = $room_id;
                $room_image->name = $filename;
                $room_image->save();
            }
        }

        $res['success'] = true;
        $res['message'] = 'Room Added successfully!';

        return response($res);
    }

    public function updateRoomStatus(Request $request, $room_id)
    {
        $room = Room::find($room_id);
        $room->active = $request->boolean('switchStatus');
        $room->save();

        $res['success'] = true;
        $res['message'] = 'Room updated successfully!';

        return response($res);
    }

    public function showUpdateRoom($property_id, $room_id)
    {
        $property = Property::find($property_id);
        $room = Room::find($room_id);
        $room_type = RoomType::all();
        $bed_type = BedType::all();
        $facility = RoomFacility::all();
        $meal_types = MealsType::all();
        $sub_room = SubRooms::where('room_id', $room_id)->get();
        $room_has_facility = $room->roomFacilities->pluck('id')->toArray();
        $room_image = RoomImage::where('room_id', $room_id)->get();
        //dd($room_image);

        $unit = DB::table('room_has_unit')
            ->join('rooms', 'room_has_unit.room_id', '=', 'rooms.id')
            ->join('units', 'room_has_unit.unit_id', '=', 'units.id')
            ->select('units.*')
            ->where('room_has_unit.room_id', '=', $room_id)
            ->get();

        $resvation_policies = ReservationPolicy::all();

        return view('account.propertyOwner.rooms.edit', [
            'rooms' => $room, 'properties' => $property, 'room_types' => $room_type, 'facility' => $facility, 'meal_types' => $meal_types, 'resvation_policies' => $resvation_policies, 'sub_rooms' => $sub_room, 'units' => $unit, 'bed_types' => $bed_type,
            'room_has_facilities' => $room_has_facility, 'room_images' => $room_image,
        ]);
    }

    public function subRoomUpdateCollectInfo(Request $request)
    {
        $sub_room_id = $request->input('subroom_id');

        $sub_room_meals_types = DB::table('sub_room_has_meals_type')
            ->where('sub_room_id', $sub_room_id)
            ->get();

        $sub_room_reservation_policy_types = DB::table('sub_room_has_reservation_policy')
            ->where('sub_room_id', $sub_room_id)
            ->get();

        $meal_types = MealsType::all();
        $resvation_policies = ReservationPolicy::all();

        $sub_room_meals_types_ids = $sub_room_meals_types->pluck('meal_type_id');
        $sub_room_reservation_policy_type_ids = $sub_room_reservation_policy_types->pluck('reservation_policy_id');
        //dd( $sub_room_meals_types_ids);
        $res['sub_room_meals_types_ids'] = $sub_room_meals_types_ids;
        $res['meal_types'] = $meal_types;
        $res['resvation_policies'] = $resvation_policies;
        $res['sub_room_reservation_policy_type_ids'] = $sub_room_reservation_policy_type_ids;

        return response()->json($res);
    }

    public function unitUpdateCollectInfo($property_id, $room_id, $unit_id)
    {
        $unit_bed_types = DB::table('unit_has_bed_type')
            ->where('unit_id', $unit_id)
            ->get();

        $bed_types = BedType::all();

        $res['unit_bed_type'] = $unit_bed_types;
        $res['bed_types'] = $bed_types;

        return response()->json($res);
    }

    public function UpdateSubRoom(Request $request, $property_id, $room_id, $sub_room_id)
    {
        $sleep_type_id = $request->input('sleep_type_id');
        $meal_type_ids = $request->input('meal_type_ids');
        $sub_room_rate = $request->input('rate');
        $resvation_policy_ids = $request->input('resvation_policy_ids');

        $sub_room = SubRooms::find($sub_room_id);
        $sub_room->sleep_count = $sleep_type_id;
        $sub_room->rate = $sub_room_rate;
        $sub_room->save();

        $sub_room_has_meal_types = SubRoomHasMealsType::where('sub_room_id', $sub_room_id)->get();
        $sub_room_has_reservation_policies = SubRoomHasReservationPolicy::where('sub_room_id', $sub_room_id)->get();

        foreach ($sub_room_has_meal_types as $sub_room_has_meal_type) {
            $sub_room_has_meal_type->delete();
        }
        foreach ($sub_room_has_reservation_policies as $sub_room_has_reservation_policy) {
            $sub_room_has_reservation_policy->delete();
        }

        for ($i = 0; $i < count($meal_type_ids); $i++) {
            DB::table('sub_room_has_meals_type')->insert([
                'sub_room_id' => $sub_room_id,
                'meal_type_id' => $meal_type_ids[$i],
            ]);
        }

        for ($i = 0; $i < count($resvation_policy_ids); $i++) {
            DB::table('sub_room_has_reservation_policy')->insert([
                'sub_room_id' => $sub_room_id,
                'reservation_policy_id' => $resvation_policy_ids[$i],
            ]);
        }

        $res['success'] = true;
        $res['message'] = 'Sub Room Updated Successfully!';

        return response($res);
    }

    public function updateUnit(Request $request, $property_id, $room_id, $unit_id)
    {
        $unit_name = $request->unit_name;
        $array_bed_type_ids = $request->bed_type_ids;
        $array_filtered_count_array = $request->filtered_count_array;
        $unit_has_bed_types = UnitHasBedType::where('unit_id', $unit_id)->get();

        foreach ($unit_has_bed_types as $unit_has_bed_type) {
            $unit_has_bed_type->delete();
        }

        $unit = Unit::find($unit_id);
        $unit->type = $unit_name;
        $unit->save();

        for ($i = 0; $i < count($array_bed_type_ids); $i++) {
            $unit_has_bed_types = new UnitHasBedType;
            $unit_has_bed_types->unit_id = $unit_id;
            $unit_has_bed_types->bed_type_id = $array_bed_type_ids[$i];
            $unit_has_bed_types->bed_count = $array_filtered_count_array[$i];
            $unit_has_bed_types->save();
        }

        $res['success'] = true;
        $res['message'] = 'Room Unit Updated Successfully!';

        return response($res);
    }

    public function deleteRoom($property_id, $room_id)
    {
        $room = Room::find($room_id);
        $room->delete();

        return Redirect::back();
    }

    public function updateRoom(Request $request, $property_id, $room_id)
    {
        //dd( $id);
        $room_type_id = $request->input('room_type_id');
        $room_title = $request->input('room_title');
        // $occupancy = $request->input('occupancy');
        // $room_rate = $request->input('rate');
        // $no_of_room = $request->input('no_of_room');
        $room_size = $request->input('room_size');
        $room_description = $request->input('description');

        // dd( $room_type_id, $room_title,$occupancy,$room_rate,$no_of_room,$id,$room_id,$room_size,$room_description);
        $room = Room::where('id', $room_id)->first();

        $room->type_id = $room_type_id;
        $room->title = $room_title;
        $room->description = $room_description;
        $room->room_size = $room_size;
        // $room->occupancy = $occupancy;
        // $room->no_of_rooms = $no_of_room;
        // $room->rate = $room_rate;
        $room->property_id = $property_id;
        $room->save();

        if ($request->hasfile('sub_images')) {
            foreach ($request->sub_images as $sub_image) {
                $file_ex = strtolower(File::extension($sub_image->getClientOriginalName()));

                if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif') {
                    $res['success'] = false;
                    $res['message'] = 'Invalid photo type!';

                    return response($res);
                }
                $filename = uniqid() . '.' . $file_ex;
                $sub_image->storeAs('public/room_image/room_sub_images', $filename);

                $room_image = new RoomImage;

                $room_image->room_id = $room_id;
                $room_image->name = $filename;
                $room_image->save();
            }
        }

        $res['success'] = true;
        $res['message'] = 'Room update successfully!';

        return response($res);
    }

    public function saveSubRoom(Request $request, $property_id, $room_id)
    {
        $sleep_type_id = $request->input('sleep_type_id');
        $meal_type_ids = $request->input('meal_type_ids');
        $sub_room_rate = $request->input('rate');
        $resvation_policy_ids = $request->input('resvation_policy_ids');

        $sub_room = new SubRooms;
        $sub_room->room_id = $room_id;
        $sub_room->sleep_count = $sleep_type_id;
        $sub_room->rate = $sub_room_rate;
        $sub_room->save();

        $sub_room_id = $sub_room->id;

        for ($i = 0; $i < count($meal_type_ids); $i++) {
            DB::table('sub_room_has_meals_type')->insert([
                'sub_room_id' => $sub_room_id,
                'meal_type_id' => $meal_type_ids[$i],
            ]);
        }

        for ($i = 0; $i < count($resvation_policy_ids); $i++) {
            DB::table('sub_room_has_reservation_policy')->insert([
                'sub_room_id' => $sub_room_id,
                'reservation_policy_id' => $resvation_policy_ids[$i],
            ]);
        }
        $res['success'] = true;
        $res['message'] = 'Sub Room Added Successfully!';

        return response($res);
    }

    public function saveUnit(Request $request, $property_id, $room_id)
    {
        $unit_name = $request->input('unit_name');
        $array_bed_type_ids = $request->input('bed_type_ids');
        $array_filtered_count_array = $request->input('filtered_count_array');

        $unit = new Unit;
        $unit->type = $unit_name;
        $unit->save();
        $unit_id = $unit->id;
        for ($i = 0; $i < count($array_bed_type_ids); $i++) {
            $unit_has_bed_type = new UnitHasBedType;
            $unit_has_bed_type->unit_id = $unit_id;
            $unit_has_bed_type->bed_type_id = $array_bed_type_ids[$i];
            $unit_has_bed_type->bed_count = $array_filtered_count_array[$i];
            $unit_has_bed_type->save();
        }

        $room_has_unit = new RoomHasUnit;
        $room_has_unit->room_id = $room_id;
        $room_has_unit->unit_id = $unit_id;
        $room_has_unit->save();

        $res['success'] = true;
        $res['message'] = 'Unit added successfully!';

        return response($res);
    }

    public function updateSubRoomStatus(Request $request, $sub_room_id)
    {
        $Sub_room = SubRooms::find($sub_room_id);
        $Sub_room->active = $request->boolean('switchStatus');
        $Sub_room->save();

        $res['success'] = true;
        $res['message'] = 'Sub Room Status Updated Successfully!';

        return response($res);
    }

    public function deleteSubRoom($property_id, $room_id, $sub_room_id)
    {
        $sub_room = SubRooms::find($sub_room_id);
        $sub_room->delete();

        return Redirect::back();
    }

    public function deleteUnitRoom($property_id, $room_id, $unit_id)
    {
        $unit = Unit::find($unit_id);
        $unit->delete();

        return Redirect::back();
    }

    public function showOwnersProperty()
    {
        $user = auth()->user()->id;
        $property = Property::where('user_id', $user)->get();

        return view('account.propertyOwner.review.all', ['properties' => $property]);
    }

    public function showPropertyReview($property_id)
    {
        $property_review = PropertyReview::where('property_id', $property_id)->get();
        //dd($property_review);
        $property = Property::find($property_id);

        return view('account.propertyOwner.review.edit', ['property_reviews' => $property_review, 'properties' => $property]);
    }

    public function showPropertyOwnerResponse($property_id, $reviw_id)
    {
        $rating_category = DB::table('review_has_review_categories')
            ->join('property_reviews', 'review_has_review_categories.review_id', '=', 'property_reviews.id')
            ->join('review_categories', 'review_has_review_categories.review_category_id', '=', 'review_categories.id')
            ->select('review_categories.name', 'review_has_review_categories.rating')
            ->where('review_has_review_categories.review_id', '=', $reviw_id)
            ->get();
        //dd($rating_category);

        $property = Property::find($property_id);
        $property_review = PropertyReview::find($reviw_id);

        return view('account.propertyOwner.review.response_details', ['rating_categories' => $rating_category, 'properties' => $property, 'property_reviews' => $property_review]);
    }

    public function saveResponse(Request $request)
    {
        $response = $request->input('response');
        $property_review = PropertyReview::find($request->review_id);
        $property_review->property_response = $response;
        $property_review->save();

        $res['success'] = true;
        $res['message'] = 'Response Added successfully!';

        return response($res);
    }

    public function showOwnersPropertyFaq()
    {
        $user = auth()->user()->id;
        $property = Property::where('user_id', $user)->get();

        return view('account.propertyOwner.FAQ.all', ['properties' => $property]);
    }

    public function showAddFaqs($property_id)
    {
        $property = Property::find($property_id);
        $property_has_faq = PropertyHasFaq::where('property_id', '=', $property_id)->get();
        //dd($property_has_faq);

        return view('account.propertyOwner.FAQ.add_faqs', ['properties' => $property, 'property_has_faqs' => $property_has_faq]);
    }

    public function saveFaqs(Request $request)
    {
        $question = $request->input('question');
        $answer = $request->input('answer');

        $property_has_faq = new PropertyHasFaq;
        $property_has_faq->property_id = $request->property_id;
        $property_has_faq->question = $question;
        $property_has_faq->answer = $answer;
        $property_has_faq->save();

        $res['success'] = true;
        $res['message'] = 'FAQ Added successfully!';

        return response($res);
    }

    public function updateFaqs(Request $request, $property_has_faq_id)
    {
        $question = $request->input('question');
        $answer = $request->input('answer');

        $property_has_faq = PropertyHasFaq::find($property_has_faq_id);
        $property_has_faq->question = $question;
        $property_has_faq->answer = $answer;
        $property_has_faq->save();

        $res['success'] = true;
        $res['message'] = 'FAQ Updated successfully!';

        return response($res);
    }

    public function deleteFaqs($property_has_faq_id)
    {
        $property_has_faq = PropertyHasFaq::find($property_has_faq_id);
        $property_has_faq->delete();

        $res['success'] = false;
        $res['message'] = 'FAQ has been Deleted!!';

        return response($res);
    }

    public function showAllBookings()
    {
        $user_id = auth()->user()->id;

        $property_ids = Property::where('user_id', $user_id)->pluck('id');
        $bookings = Booking::with('bookingStatus')->whereIn('property_id', $property_ids)->get();

        // dd($bookings[0]->property);
        return view('account.propertyOwner.bookings.all', ['bookings' => $bookings]);
    }

    public function showBookingDetails($id)
    {
        $booking = Booking::Where('id', $id)->first();
        $booking_has_sub_rooms = BookingHasSubroom::with(['rooms', 'subRooms'])->where('booking_id', $id)->get();

        return view('account.propertyOwner.bookings.details', ['booking' => $booking, 'booking_sub_rooms' => $booking_has_sub_rooms]);
    }

    public function updateBookingStatus(Request $request)
    {
        $booking_id = $request->input('booking_id');
        $status = $request->input('status');

        $booking_status = BookingStatus::where('type', $status)->first();

        $booking = Booking::where('id', $booking_id)->first();
        $booking->status_id = $booking_status->id;
        $booking->save();

        $res['success'] = true;
        $res['message'] = 'Status Updated successfully!';

        return response($res);
    }

    public function showAlPayments()
    {
        $user_id = auth()->user()->id;
        $booking_statuses = BookingStatus::whereIn('type', [BookingStatusType::CONFIRMED, BookingStatusType::BOOKING_DONE, BookingStatusType::PAYMENT_SETTLED])->pluck('id');

        $filters = false;

        $credit_bookings = collect();
        $debit_bookings = collect();

        $property_ids = Property::where('user_id', $user_id)->pluck('id');
        $credit_bookings = Booking::with('bookingStatus')->whereIn('property_id', $property_ids)
            ->where('payment_type', BookingPaymentType::PAY_AT_LOCATION)->whereIn('status_id', $booking_statuses)->get();

        $debit_bookings = Booking::with('bookingStatus')->whereIn('property_id', $property_ids)
            ->where('payment_type', BookingPaymentType::ONLINE)->whereIn('status_id', $booking_statuses)->get();

        // dd($credit_bookings);

        $credit_total = 0;
        $debit_total = 0;

        foreach ($credit_bookings as $key => $booking) {
            if ($booking->bookingStatus->type != 'payment-settled') {
                $credit_total = $credit_total + $booking->gimanhal_fee;
            }
        }

        foreach ($debit_bookings as $key => $booking) {
            if ($booking->bookingStatus->type != 'payment-settled') {
                $debit_total = $debit_total + $booking->property_owner_fee;
            }
        }

        return view('account.propertyOwner.payments.all', [
            'credit_total' => $credit_total,
            'credit_bookings' => $credit_bookings, 'debit_total' => $debit_total, 'debit_bookings' => $debit_bookings,
        ]);
    }
}
