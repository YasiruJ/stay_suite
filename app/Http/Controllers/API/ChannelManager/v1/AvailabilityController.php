<?php

namespace App\Http\Controllers\API\ChannelManager\v1;

use App\Enums\BookingStatusType;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\ApiResourceCollection;
use App\Models\AvailabilityRoomCount;
use App\Models\AvailabilityRoomRate;
use App\Models\AvailabilityRoomStatus;
use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\MealsType;
use App\Models\Property;
use App\Models\ReservationPolicy;
use App\Models\Room;
use App\Models\SubRooms;
use DateTime;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AvailabilityController extends Controller
{
    public function getAvailabilityForDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $date = $this->removeTimeFromDate($request->input('date'));

        $properties = Property::with(['rooms' => function (Builder $query) {
            $query->whereHas('subRooms', function (Builder $query) {
                $query->where('active', true);
            });
        }])
            ->where('user_id', auth()->id())
            ->where('admin_active', true)
            ->where('property_active', true)
            ->get();

        $bookingStatusIdList = BookingStatus::whereIn('type', [
            BookingStatusType::BOOKING_DONE,
        ])
            ->get()
            ->pluck('id')
            ->toArray();

        for ($i = 0; $i < count($properties); $i++) {
            $property = $properties[$i];

            for ($j = 0; $j < count($property->rooms); $j++) {
                $room = $property->rooms[$j];

                $properties[$i]->rooms[$j]->is_available = true;
                $properties[$i]->rooms[$j]->booked_count = 0;
            }
        }

        for ($i = 0; $i < count($properties); $i++) {
            $property = $properties[$i];

            $bookingList = Booking::whereIn('status_id', $bookingStatusIdList)
                ->where('property_id', $property->id)
                ->where(DB::raw('DATE(check_in_date)'), '<=', $date)
                ->where(DB::raw('DATE(check_out_date)'), '>=', $date)
                ->select('*', DB::raw("DATE_FORMAT(check_in_date, '%Y-%m-%d') as formatted_check_in_date"), DB::raw("DATE_FORMAT(check_out_date, '%Y-%m-%d') as formatted_check_out_date"))
                ->get();

            $roomIdList = $property->rooms->pluck('id')->toArray();

            $availabilityRoomStatusList = AvailabilityRoomStatus::whereIn('room_id', $roomIdList)
                ->where(DB::raw('DATE(date)'), $date)
                ->select('*', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as formatted_date"))
                ->get();

            $availabilityRoomCountList = AvailabilityRoomCount::whereIn('room_id', $roomIdList)
                ->where(DB::raw('DATE(date)'), $date)
                ->select('*', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as formatted_date"))
                ->get();

            for ($j = 0; $j < count($property->rooms); $j++) {
                $room = $property->rooms[$j];

                $availabilityRoomStatus = $availabilityRoomStatusList->where('room_id', $room->id);

                if (count($availabilityRoomStatus) > 0) {
                    $properties[$i]->rooms[$j]->is_available = false;
                }
                $availabilityRoomCount = AvailabilityRoomCount::whereDate('date', $date)
                    ->where('room_id', $room->id)
                    ->first();

                if ($availabilityRoomCount) {
                    $properties[$i]->rooms[$j]->room_count = $availabilityRoomCount->room_count;

                    if ($availabilityRoomCount->room_count == 0) {
                        $properties[$i]->rooms[$j]->is_available = false;
                    }
                }

                $availabilityRoomCount = $availabilityRoomCountList->where('room_id', $room->id);

                if ($availabilityRoomCount->count() > 0) {
                    $availabilityRoomCountItem = $availabilityRoomCount->first();

                    if ($properties[$i]->rooms[$j]->room_count > $availabilityRoomCountItem->room_count) {
                        $properties[$i]->rooms[$j]->room_count = $availabilityRoomCountItem->room_count;
                    }

                    if ($properties[$i]->rooms[$j]->room_count == 0) {
                        $properties[$i]->rooms[$j]->is_available = false;
                    }
                }

                $bookedRoomTotal = 0;

                foreach ($bookingList as $b) {
                    foreach ($b->subRooms as $s) {
                        if ($s->room_id == $room->id) {
                            $bookedRoomTotal++;
                        }
                    }
                }

                $properties[$i]->rooms[$j]->booked_count = $bookedRoomTotal;
            }
        }

        return new ApiResourceCollection($properties);
    }

    public function getAvailabilityForDateRange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $dateArr = $this->getBetweenDates($request->input('start_date'), $request->input('end_date'));

        $dateList = array_unique(array_column($dateArr, 'date'));

        $properties = Property::with(['rooms' => function (Builder $query) {
            $query->whereHas('subRooms', function (Builder $query) {
                $query->where('active', true);
            });
        }])
            ->where('user_id', auth()->id())
            ->where('admin_active', true)
            ->where('property_active', true)
            ->get();

        $bookingStatusIdList = BookingStatus::whereIn('type', [
            BookingStatusType::BOOKING_DONE,
        ])
            ->get()
            ->pluck('id')
            ->toArray();

        foreach ($properties as $property) {
            $bookingList = Booking::whereIn('status_id', $bookingStatusIdList)
                ->where('property_id', $property->id)
                ->select('*', DB::raw("DATE_FORMAT(check_in_date, '%Y-%m-%d') as formatted_check_in_date"), DB::raw("DATE_FORMAT(check_out_date, '%Y-%m-%d') as formatted_check_out_date"))
                ->get();

            $roomIdList = $property->rooms->pluck('id')->toArray();

            $availabilityRoomStatusList = AvailabilityRoomStatus::whereIn('room_id', $roomIdList)
                ->whereIn(DB::raw('DATE(date)'), $dateList)
                ->select('*', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as formatted_date"))
                ->get();

            $availabilityRoomCountList = AvailabilityRoomCount::whereIn('room_id', $roomIdList)
                ->whereIn(DB::raw('DATE(date)'), $dateList)
                ->select('*', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as formatted_date"))
                ->get();

            foreach ($property->rooms as $room) {
                for ($i = 0; $i < count($dateArr); $i++) {
                    $date = $dateArr[$i]->date;

                    $availabilityRoomStatus = $availabilityRoomStatusList->where('formatted_date', $date)
                        ->where('room_id', $room->id);

                    if (count($availabilityRoomStatus) > 0) {
                        $dateArr[$i]->is_available = true;

                        continue;
                    }

                    $availabilityRoomCount = $availabilityRoomCountList->where('formatted_date', $date)
                        ->where('room_id', $room->id);

                    if ($availabilityRoomCount->count() > 0) {
                        $availabilityRoomCountItem = $availabilityRoomCount->first();

                        if ($availabilityRoomCountItem->room_count == 0) {
                            $dateArr[$i]->is_available = true;
                        }
                    }

                    $filteredBookingList = $bookingList->filter(function ($query) use ($date) {
                        $d = strtotime($date);
                        $check_in_date = strtotime($query->formatted_check_in_date);
                        $check_out_date = strtotime($query->formatted_check_out_date);

                        return $d >= $check_in_date && $d <= $check_out_date;
                    });

                    $bookedRoomTotal = 0;

                    foreach ($filteredBookingList as $b) {
                        foreach ($b->subRooms as $s) {
                            if ($s->room_id == $room->id) {
                                $bookedRoomTotal++;
                            }
                        }
                    }

                    if ($bookedRoomTotal > 0) {
                        $dateArr[$i]->is_booked = true;
                    }
                }
            }
        }

        return response()->json($dateArr, 200);
    }

    public function getAvailabilityForDateRangeAll(Request $request, $property_id)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $dateArr = $this->getBetweenDatesTemp($request->input('start_date'), $request->input('end_date'));

        $property = Property::where('id', '=', $property_id)
            ->where('admin_active', true)
            ->where('property_active', true)
            ->first();

        if (! $property) {
            return response(['errors' => 'Property not found.'], 205);
        }

        $rooms = Room::withWhereHas('subRooms', function ($query) {
            $query->where('active', true);
        })
            ->where('property_id', $property->id)
            ->where('active', true)
            ->get();

        $roomIdList = $rooms->pluck('id')->toArray();

        $availabilityRoomStatusList = AvailabilityRoomStatus::whereIn('room_id', $roomIdList)
            ->whereIn(DB::raw('DATE(date)'), $dateArr)
            ->select('*', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as formatted_date"))
            ->get();

        $availabilityRoomCountList = AvailabilityRoomCount::whereIn('room_id', $roomIdList)
            ->whereIn(DB::raw('DATE(date)'), $dateArr)
            ->select('*', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as formatted_date"))
            ->get();

        $availabilityRoomRateList = AvailabilityRoomRate::with('mealTypes', 'reservationPolicies')
            ->whereIn('room_id', $roomIdList)
            ->whereIn(DB::raw('DATE(date)'), $dateArr)
            ->select('*', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as formatted_date"))
            ->get();

        $bookingStatusIdList = BookingStatus::whereIn('type', [
            BookingStatusType::BOOKING_DONE,
        ])
            ->get()
            ->pluck('id')
            ->toArray();

        $bookingList = Booking::where('property_id', $property->id)
            ->whereIn('status_id', $bookingStatusIdList)
            ->select('*', DB::raw("DATE_FORMAT(check_in_date, '%Y-%m-%d') as formatted_check_in_date"), DB::raw("DATE_FORMAT(check_out_date, '%Y-%m-%d') as formatted_check_out_date"))
            ->get();

        for ($i = 0; $i < count($rooms); $i++) {
            $room = $rooms[$i];

            $rooms[$i]->is_available = true;
        }

        $rateArr = [];
        $bookedRoomCountForEachDayArr = [];

        for ($i = 0; $i < count($dateArr); $i++) {
            $date = $dateArr[$i];

            $filteredBookingList = $bookingList->filter(function ($query) use ($date) {
                $d = strtotime($date);
                $check_in_date = strtotime($query->formatted_check_in_date);
                $check_out_date = strtotime($query->formatted_check_out_date);

                return $d >= $check_in_date && $d <= $check_out_date;
            });

            for ($j = 0; $j < count($rooms); $j++) {
                $room = $rooms[$j];

                $availabilityRoomStatus = $availabilityRoomStatusList->where('formatted_date', $date)
                    ->where('room_id', $room->id);

                if (count($availabilityRoomStatus) > 0) {
                    $rooms[$j]->is_available = false;
                }

                $availabilityRoomCount = $availabilityRoomCountList->where('formatted_date', $date)
                    ->where('room_id', $room->id);

                if ($availabilityRoomCount->count() > 0) {
                    $availabilityRoomCountItem = $availabilityRoomCount->first();

                    if ($rooms[$j]->room_count > $availabilityRoomCountItem->room_count) {
                        $rooms[$j]->room_count = $availabilityRoomCountItem->room_count;
                    }

                    if ($rooms[$j]->room_count < 1) {
                        $rooms[$j]->is_available = false;
                    }
                }

                $bookedRoomTotal = 0;

                foreach ($filteredBookingList as $b) {
                    foreach ($b->subRooms as $s) {
                        if ($s->room_id == $room->id) {
                            $bookedRoomTotal++;
                        }
                    }
                }

                $bookedRoomCountForEachDayArr[$room->id][] = $bookedRoomTotal;

                for ($k = 0; $k < count($room->subRooms); $k++) {
                    $subRoom = $room->subRooms[$k];

                    $availabilityRoomRate = $availabilityRoomRateList->where('formatted_date', $date)
                        ->where('sub_room_id', $subRoom->id)
                        ->where('room_id', $room->id);

                    if (count($availabilityRoomRate) > 0) {
                        $availabilityRoomRateItem = $availabilityRoomRate->first();

                        if ($subRoom->sleep_count > $availabilityRoomRateItem->sleep_count) {
                            $rooms[$j]->subRooms[$k]->sleep_count = $availabilityRoomRateItem->sleep_count;
                        }

                        $obj = new AvailabilityRateObject;
                        $obj->date = $date;
                        $obj->roomId = $room->id;
                        $obj->subRoomId = $subRoom->id;
                        $obj->rate = $availabilityRoomRateItem->room_rate;

                        $rateArr[] = $obj;

                    // if (count($availabilityRoomRateItem->mealTypes) > 0) {
                        //     $rooms[$j]->subRooms[$k]->mealTypes = $availabilityRoomRateItem->mealTypes;
                    // }

                    // if (count($availabilityRoomRateItem->reservationPolicies) > 0) {
                        //     $rooms[$j]->subRooms[$k]->reservationPolicies = $availabilityRoomRateItem->reservationPolicies;
                    // }
                    } else {
                        $obj = new AvailabilityRateObject;
                        $obj->date = $date;
                        $obj->roomId = $room->id;
                        $obj->subRoomId = $subRoom->id;
                        $obj->rate = $subRoom->rate;

                        $rateArr[] = $obj;
                    }
                }
            }
        }

        $roomIds = array_values(array_unique(array_column($rateArr, 'roomId')));
        $subRoomIds = array_values(array_unique(array_column($rateArr, 'subRoomId')));

        $rateArrFinal = [];

        for ($i = 0; $i < count($roomIds); $i++) {
            for ($j = 0; $j < count($subRoomIds); $j++) {
                $rateArrFinal[$roomIds[$i]][$subRoomIds[$j]] = 0;
            }
        }

        for ($i = 0; $i < count($rateArr); $i++) {
            $a = $rateArr[$i];

            $rateArrFinal[$a->roomId][$a->subRoomId] += $a->rate;
        }

        for ($i = 0; $i < count($rooms); $i++) {
            $room = $rooms[$i];

            $bookedRoomCount = max($bookedRoomCountForEachDayArr[$room->id]);

            $rooms[$i]->room_count -= $bookedRoomCount;

            if ($rooms[$i]->room_count < 1) {
                $rooms[$i]->is_available = false;
            }

            for ($j = 0; $j < count($room->subRooms); $j++) {
                $subRoom = $room->subRooms[$j];

                $rooms[$i]->subRooms[$j]->rate = $rateArrFinal[$room->id][$subRoom->id];
            }
        }

        return new ApiResourceCollection($rooms);
    }

    public function updateRoomStatus(Request $request, $property_id, $room_id)
    {
        $validator = Validator::make($request->all(), [
            'dates' => ['required', 'array', 'min:1'],
            'dates.*' => ['required', 'date'],
            'status' => ['required', Rule::in(['OPEN', 'CLOSE'])],
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $property = Property::where('id', $property_id)
            ->where('user_id', auth()->user()->id)
            ->where('admin_active', true)
            ->where('property_active', true)
            ->first();

        if (! $property) {
            return response(['errors' => 'Property not found.'], 205);
        }

        $room = Room::where('id', $room_id)
            ->where('property_id', $property->id)
            ->where('active', true)
            ->first();

        if (! $room) {
            return response(['errors' => 'Room not found.'], 205);
        }

        $incomingDates = $request->input('dates');

        for ($i = 0; $i < count($incomingDates); $i++) {
            $incomingDates[$i] = $this->removeTimeFromDate($incomingDates[$i]);
        }

        switch ($request->input('status')) {
            case 'CLOSE':
                $availabilityRoomStatusList = AvailabilityRoomStatus::where('room_id', $room->id)
                    ->whereIn(DB::raw('DATE(date)'), $incomingDates)
                    ->select('*', DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as formatted_date"))
                    ->get();

                for ($i = 0; $i < count($incomingDates); $i++) {
                    $availabilityRoomStatus = $availabilityRoomStatusList->where('formatted_date', $incomingDates[$i]);

                    if (count($availabilityRoomStatus) == 0) {
                        $av = new AvailabilityRoomStatus;

                        $av->date = $incomingDates[$i];
                        $av->is_room_available = 0;
                        $av->room_id = $room->id;

                        $av->save();
                    }

                    if (count($availabilityRoomStatus) > 1) {
                        $arr = $availabilityRoomStatus->slice(1);

                        foreach ($arr as $a) {
                            $a->delete();
                        }
                    }
                }

                break;

            case 'OPEN':
                AvailabilityRoomStatus::whereIn(DB::raw('DATE(date)'), $incomingDates)
                    ->where('room_id', $room->id)
                    ->delete();

                break;
        }

        return response([
            'message' => 'Success',
        ], 200);
    }

    public function updateRoomCount(Request $request, $property_id, $room_id)
    {
        $validator = Validator::make($request->all(), [
            'dates' => ['required', 'array', 'min:1'],
            'dates.*' => ['required', 'date'],
            'count' => ['required', 'integer', 'min:0'],
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $property = Property::where('id', $property_id)
            ->where('user_id', auth()->user()->id)
            ->where('admin_active', true)
            ->where('property_active', true)
            ->first();

        if (! $property) {
            return response(['errors' => 'Property not found.'], 205);
        }

        $room = Room::where('id', $room_id)
            ->where('property_id', $property->id)
            ->where('active', true)
            ->first();

        if (! $room) {
            return response(['errors' => 'Room not found.'], 205);
        }

        $incomingDates = $request->input('dates');

        for ($i = 0; $i < count($incomingDates); $i++) {
            $incomingDates[$i] = $this->removeTimeFromDate($incomingDates[$i]);
        }

        AvailabilityRoomCount::whereIn(DB::raw('DATE(date)'), $incomingDates)
            ->where('room_id', $room->id)
            ->delete();

        if ($request->input('count') != $room->room_count) {
            for ($i = 0; $i < count($incomingDates); $i++) {
                $a = AvailabilityRoomCount::whereDate('date', $incomingDates[$i])
                    ->where('room_id', $room->id)
                    ->delete();

                $av = new AvailabilityRoomCount;

                $av->date = $incomingDates[$i];
                $av->room_count = $request->input('count');
                $av->room_id = $room->id;

                $av->save();
            }
        }

        return response([
            'message' => 'Success',
        ], 200);
    }

    public function updateRoomRate(Request $request, $property_id, $room_id, $sub_room_id)
    {
        $validator = Validator::make($request->all(), [
            'dates' => ['required', 'array', 'min:1'],
            'dates.*' => ['required', 'date'],
            'sleep_count' => ['required', 'integer', 'min:1'],
            'rate' => ['required', 'integer', 'min:1'],
        ]);

        $incomingDates = $request->input('dates');
        $sleep_count = intval($request->input('sleep_count'));
        $rate = ($request->input('rate'));

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $property = Property::where('id', $property_id)
            ->where('user_id', auth()->user()->id)
            ->where('admin_active', true)
            ->where('property_active', true)
            ->first();

        if (! $property) {
            return response(['errors' => 'Property not found.'], 205);
        }

        $room = Room::where('id', $room_id)
            ->where('property_id', $property->id)
            ->where('active', true)
            ->first();

        if (! $room) {
            return response(['errors' => 'Room not found.'], 205);
        }

        $subRoom = SubRooms::where('id', $sub_room_id)
            ->where('room_id', $room->id)
            ->where('active', true)
            ->first();

        if (! $subRoom) {
            return response(['errors' => 'Sub Room not found.'], 205);
        }

        for ($i = 0; $i < count($incomingDates); $i++) {
            $incomingDates[$i] = $this->removeTimeFromDate($incomingDates[$i]);
        }

        AvailabilityRoomRate::whereIn(DB::raw('DATE(date)'), $incomingDates)
            ->where('sub_room_id', $subRoom->id)
            ->where('room_id', $room->id)
            ->delete();

        for ($i = 0; $i < count($incomingDates); $i++) {
            if (
                ! ($request->input('rate') == $subRoom->rate &&
                    $subRoom->sleep_count == $sleep_count)
            ) {
                $av = new AvailabilityRoomRate;

                $av->date = $incomingDates[$i];
                $av->room_rate = $rate;
                $av->sub_room_id = $subRoom->id;
                $av->room_id = $room->id;
                $av->sleep_count = $sleep_count;

                $av->save();
            }
        }

        return response([
            'message' => 'Success',
        ], 200);
    }

    public function updateRoomRateOld(Request $request, $property_id, $room_id, $sub_room_id)
    {
        $validator = Validator::make($request->all(), [
            'dates' => ['required', 'array', 'min:1'],
            'dates.*' => ['required', 'date'],
            'meal_type_id_arr' => ['required', 'array', 'min:1'],
            'meal_type_id_arr.*' => ['required', 'integer'],
            'reservation_policy_id_arr' => ['required', 'array', 'min:1'],
            'reservation_policy_id_arr.*' => ['required', 'integer'],
            'sleep_count' => ['required', 'integer', 'min:1'],
            'rate' => ['required', 'integer', 'min:1'],
        ]);

        $incomingDates = $request->input('dates');
        $meal_type_id_arr = array_map('intval', $request->input('meal_type_id_arr'));
        $reservation_policy_id_arr = array_map('intval', $request->input('reservation_policy_id_arr'));
        $sleep_count = intval($request->input('sleep_count'));
        $rate = ($request->input('rate'));

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $property = Property::where('id', $property_id)
            ->where('user_id', auth()->user()->id)
            ->where('admin_active', true)
            ->where('property_active', true)
            ->first();

        if (! $property) {
            return response(['errors' => 'Property not found.'], 205);
        }

        $room = Room::where('id', $room_id)
            ->where('property_id', $property->id)
            ->where('active', true)
            ->first();

        if (! $room) {
            return response(['errors' => 'Room not found.'], 205);
        }

        $subRoom = SubRooms::with('mealTypes', 'reservationPolicies')
            ->where('id', $sub_room_id)
            ->where('room_id', $room->id)
            ->where('active', true)
            ->first();

        if (! $subRoom) {
            return response(['errors' => 'Sub Room not found.'], 205);
        }

        $mealTypes = MealsType::whereIn('id', $meal_type_id_arr)
            ->get();

        if (count($mealTypes) != count($meal_type_id_arr)) {
            return response(['errors' => 'Meal Type not found.'], 205);
        }

        $ReservationPolicies = ReservationPolicy::whereIn('id', $reservation_policy_id_arr)
            ->get();

        if (count($ReservationPolicies) != count($reservation_policy_id_arr)) {
            return response(['errors' => 'Reservation Policy not found.'], 205);
        }

        for ($i = 0; $i < count($incomingDates); $i++) {
            $incomingDates[$i] = $this->removeTimeFromDate($incomingDates[$i]);
        }

        $subRoomMealTypeId = $subRoom->mealTypes()->pluck('meals_types.id')->toArray();
        $subRoomReservationPoliciesIdArr = $subRoom->reservationPolicies()->pluck('reservation_policies.id')->toArray();

        for ($i = 0; $i < count($incomingDates); $i++) {
            $availabilityRoomRateList = AvailabilityRoomRate::with('mealTypes', 'reservationPolicies')
                ->whereDate('date', $incomingDates[$i])
                ->where('sub_room_id', $subRoom->id)
                ->where('room_id', $room->id)
                ->get();

            if (count($availabilityRoomRateList) == 0) {
                if (
                    ! ($request->input('rate') == $subRoom->rate &&
                        $subRoom->sleep_count == $sleep_count &&
                        $this->array_equal($subRoomMealTypeId, $meal_type_id_arr) &&
                        $this->array_equal($subRoomReservationPoliciesIdArr, $reservation_policy_id_arr))
                ) {
                    $av = new AvailabilityRoomRate;

                    $av->date = $incomingDates[$i];
                    $av->room_rate = $rate;
                    $av->sub_room_id = $subRoom->id;
                    $av->room_id = $room->id;
                    $av->sleep_count = $sleep_count;

                    $av->save();
                    $av->refresh();

                    $av->mealTypes()->attach($meal_type_id_arr);

                    $av->reservationPolicies()->attach($reservation_policy_id_arr);

                    $av->save();
                }
            } else {
                for ($j = 0; $j < count($availabilityRoomRateList); $j++) {
                    $availabilityRoomRate = $availabilityRoomRateList[$j];

                    $availabilityRoomRate->delete();

                    if (
                        ! ($request->input('rate') == $subRoom->rate &&
                            $subRoom->sleep_count == $sleep_count &&
                            $this->array_equal($subRoomMealTypeId, $meal_type_id_arr) &&
                            $this->array_equal($subRoomReservationPoliciesIdArr, $reservation_policy_id_arr))
                    ) {
                        $av = new AvailabilityRoomRate;

                        $av->date = $incomingDates[$i];
                        $av->room_rate = $rate;
                        $av->sub_room_id = $subRoom->id;
                        $av->room_id = $room->id;
                        $av->sleep_count = $sleep_count;

                        $av->save();
                        $av->refresh();

                        $av->mealTypes()->attach($meal_type_id_arr);

                        $av->reservationPolicies()->attach($reservation_policy_id_arr);

                        $av->save();
                    }
                }
            }
        }

        return response([
            'message' => 'Success',
        ], 200);
    }

    private function removeTimeFromDate(string $date): string
    {
        $dt = new DateTime($date);

        return $dt->format('Y-m-d');
    }

    private function array_equal($a, $b): bool
    {
        return is_array($a)
            && is_array($b)
            && count($a) == count($b)
            && array_diff($a, $b) === array_diff($b, $a);
    }

    private function getBetweenDates($startDate, $endDate)
    {
        $rangArray = [];

        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        for (
            $currentDate = $startDate;
            $currentDate <= $endDate;
            $currentDate += (86400)
        ) {
            $date = date('Y-m-d', $currentDate);

            $obj = new DateObject;
            $obj->date = $date;
            $obj->is_available = false;

            $rangArray[] = $obj;
        }

        return $rangArray;
    }

    private function getBetweenDatesTemp($startDate, $endDate)
    {
        $rangArray = [];

        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        for (
            $currentDate = $startDate;
            $currentDate <= $endDate;
            $currentDate += (86400)
        ) {
            $date = date('Y-m-d', $currentDate);

            $rangArray[] = $date;
        }

        return $rangArray;
    }
}

class DateObject
{
    public $date;
    public $is_available = false;
    public $is_booked = false;
}

class AvailabilityRateObject
{
    public $date;
    public $roomId;
    public $subRoomId;
    public $rate;
}
