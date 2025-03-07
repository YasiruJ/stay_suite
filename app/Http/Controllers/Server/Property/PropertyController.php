<?php

namespace App\Http\Controllers\Server\Property;

use App\Http\Controllers\Controller;
use App\Models\AvailabilityRoomCount;
use App\Models\AvailabilityRoomRate;
use App\Models\AvailabilityRoomStatus;
use App\Models\Booking;
use App\Models\BookingHasSubroom;
use App\Models\City;
use App\Models\GimanhalFee;
use App\Models\MealsType;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Models\PropertyImage;
use App\Models\PropertyReview;
use App\Models\PropertyType;
use App\Models\ReservationPolicy;
use App\Models\ReviewCategory;
use App\Models\ReviewGuestType;
use App\Models\ReviewHasReviewCategory;
use App\Models\ReviewScore;
use App\Models\Room;
use App\Models\RoomSubFacilities;
use App\Repository\PropertyRepositoryInterface;
use App\Traits\CalculateAvgReviewScore;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AvailabilityRateObject
{
    public $date;
    public $roomId;
    public $subRoomId;
    public $rate;
}
class PropertyController extends Controller
{
    use CalculateAvgReviewScore;

    private $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function showPropertyList()
    {
        $cities = City::all();
        $properties_list = $this->propertyRepository->allPropeties()->paginate(10);
        $property_facilities = PropertyFacility::all();

        $property_types = PropertyType::all();
        $room_sub_facilities = RoomSubFacilities::all();
        $reservation_policies = ReservationPolicy::all();
        $meal_types = MealsType::all();
        $review_score = ReviewScore::all();

        return view('home.property_list', [
            'properties' => $properties_list,
            'cities' => $cities, 'property_facilities' => $property_facilities,
            'property_types' => $property_types,
            'room_sub_facilities' => $room_sub_facilities,
            'reservation_policies' => $reservation_policies,
            'meal_types' => $meal_types,
            'review_scores' => $review_score,
        ]);
    }

    public function showPropertyDetails($property_id, Request $request)
    {
        $date_selected = false;
        $set_date = '';
        $property = $this->propertyRepository->findProperty($property_id);
        $rooms = collect();

        $review_guest_type = ReviewGuestType::all();
        $property->property_clicks = $property->property_clicks + 1;
        $property->save();
        $property_images = PropertyImage::where('property_id', $property_id)->get();
        $review_category = ReviewCategory::all();
        $reviews = PropertyReview::where('property_id', $property_id)->get();
        //dd($review_category);

        $property_review_category_avg_rating = [];
        // $property_review_category_avg_rating = DB::table('review_has_review_categories')
        //     ->join('review_categories', 'review_has_review_categories.review_category_id', '=', 'review_categories.id')
        //     ->join('property_reviews', 'review_has_review_categories.review_id', '=', 'property_reviews.id')
        //     ->where('property_reviews.property_id', $property_id)
        //     ->groupBy('review_has_review_categories.review_category_id')
        //     ->select(
        //         'review_has_review_categories.review_category_id',
        //         'review_categories.name as review_category_name',
        //         DB::raw('ROUND(avg(review_has_review_categories.rating),1) as average_rating')
        //     )
        //     ->get();
        //dd($property_review_category_avg_rating);

        // dd($property->main_image);
        $property_credit_card = DB::table('property_has_credit_cards')
            ->join('credit_cards', 'property_has_credit_cards.credit_card_id', '=', 'credit_cards.id')
            ->where('property_id', '=', $property_id)
            ->select('credit_cards.*')
            ->get();

        $rooms = Room::with([
            'subRooms' => function (Builder $query) {
                $query->where('active', 1);
            },
        ])
            ->where('property_id', $property_id)
            ->where('active', 1)
            ->get();

        $rooms = Room::with([
            'subRooms' => function (Builder $query) {
                $query->where('active', 1);
            },
        ])
            ->where('property_id', $property_id)
            ->where('active', 1)
            ->get();

        for ($j = 0; $j < count($rooms); $j++) {
            $room = $rooms[$j];

            $rooms[$j]->is_available = true;
        }

        $startDate = '';
        $endDate = '';
        // dd($rooms);
        // dd($request->query('dates') && $request->query('room_count') && $request->query('dates'));

        // dd($rooms);
        // dd($request->query('dates') && $request->query('room_count') && $request->query('dates'));
        if ($request->query('from_date') && $request->query('to_date')) {


            $validator = Validator::make($request->all(), [
                'from_date' => ['required', 'date'],
                'to_date' => ['required', 'date', 'after:from_date'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error');
            }

            // dump($rooms);
            $date_selected = true;
            $from_date = $request->query('from_date');
            $to_date = $request->query('to_date');
            // dd(new Date($from_date));



            $set_date = "$from_date - $to_date";
            // $update_dt = $dt;

            $startDate = Carbon::create($from_date)->format('D j F Y');
            $endDate = Carbon::create($to_date)->format('D j F Y');


            $rate_to_dates = [];

            $dateArr = $this->getBetweenDatesTemp($from_date, $to_date);

            $rateArr = [];
//  dd($booking_exist);

            $booked_rooms = [];

            $bookings_exists = Booking::with('subRooms')->whereIn('check_in_date', $dateArr)->orwhereIn('check_out_date', $dateArr)->get();
            foreach ($rooms as $key => $room) {
                if($bookings_exists) {
                    foreach ($bookings_exists as $key => $booking) {
                       $booked_count = BookingHasSubroom::where('booking_id',$booking->id)->where('room_id',$room->id)->count();
                    //    dump($booked_count);
                       $room->room_count -= $booked_count;
                    }
                }
            }


            // dump();
            for ($i = 0; $i < count($dateArr); $i++) {
                $date = $dateArr[$i];
                // dump($date);
                for ($j = 0; $j < count($rooms); $j++) {
                    $room = $rooms[$j];


                     $availabilityRoomStatus = AvailabilityRoomStatus::whereDate('date', $date)
                        ->where('room_id', $room->id)
                        ->first();

                    if ($availabilityRoomStatus) {
                        $rooms[$j]->is_available = false;
                    }

                    $availabilityRoomCount = AvailabilityRoomCount::whereDate('date', $date)
                        ->where('room_id', $room->id)
                        ->first();

                    if ($availabilityRoomCount) {
                        if ($rooms[$j]->room_count > $availabilityRoomCount->room_count) {
                            $rooms[$j]->room_count = $availabilityRoomCount->room_count;
                        }

                        if ($availabilityRoomCount->room_count == 0) {
                            $rooms[$j]->is_available = false;
                        }
                    }

                    for ($k = 0; $k < count($room->subRooms); $k++) {

                        //================after booking table check============
                        $subRoom = $room->subRooms[$k];

                        $availabilityRoomRate = AvailabilityRoomRate::with('mealTypes', 'reservationPolicies')
                            ->whereDate('date', $date)
                            ->where('sub_room_id', $subRoom->id)
                            ->where('room_id', $room->id)
                            ->first();

                        if ($availabilityRoomRate) {
                            if ($subRoom->sleep_count > $availabilityRoomRate->sleep_count) {
                                $rooms[$j]->subRooms[$k]->sleep_count = $availabilityRoomRate->sleep_count;
                            }

                            $obj = new AvailabilityRateObject;
                            $obj->date = $date;
                            $obj->roomId = $room->id;
                            $obj->subRoomId = $subRoom->id;
                            $obj->rate = $availabilityRoomRate->room_rate;

                            $rateArr[] = $obj;

                        // if (count($availabilityRoomRate->mealTypes) > 0) {
                            //     $rooms[$j]->subRooms[$k]->mealTypes = $availabilityRoomRate->mealTypes;
                        // }

                        // if (count($availabilityRoomRate->reservationPolicies) > 0) {
                            //     $rooms[$j]->subRooms[$k]->reservationPolicies = $availabilityRoomRate->reservationPolicies;
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

            $roomIds = array_unique(array_column($rateArr, 'roomId'));
            $subRoomIds = array_unique(array_column($rateArr, 'subRoomId'));

            // dump($roomIds);
            // dump($subRoomIds);

            $rateArrFinal = [];

            foreach ($roomIds as $room_id) {
                foreach ($subRoomIds as $key => $subroom_id) {
                    // dump($room_id);
                    $rateArrFinal[$room_id][$subroom_id] = 0;
                }
            }

            // dd($rateArrFinal);

            // for ($i = 0; $i < count($roomIds); $i++) {
            //     for ($j = 0; $j < count($subRoomIds); $j++) {
            //         // $rateArrFinal[$roomIds[$i]][$subRoomIds[$j]] = 0;
            //     }
            // }

            for ($i = 0; $i < count($rateArr); $i++) {
                $a = $rateArr[$i];

                $rateArrFinal[$a->roomId][$a->subRoomId] += $a->rate;
            }




            for ($i = 0; $i < count($rooms); $i++) {
                $room = $rooms[$i];

                for ($j = 0; $j < count($room->subRooms); $j++) {
                    $subRoom = $room->subRooms[$j];

                    $rooms[$i]->subRooms[$j]->rate = $rateArrFinal[$room->id][$subRoom->id];
                }
            }
        } else {
            // dd("htes");
            $date_selected = false;
        }

        // dd($count);
        // dd($rooms);
        //   dd($startDate);
        $fee = GimanhalFee::first()->fee;
        // dd($set_date);
        return view('home.property_details', [
            'property' => $property, 'rooms' => $rooms, 'property_images' => $property_images, 'review_categories' => $review_category,
            'review_guest_types' => $review_guest_type, 'reviews' => $reviews,
            'property_credit_cards' => $property_credit_card, 'property_review_categories_avg_rating' => $property_review_category_avg_rating,
            'date_selected' => $date_selected, 'start_date' => $startDate, 'end_date' => $endDate, 'gimanhal_fee' => $fee,
            'set_date' => $set_date,
        ]);
    }

    public function searchProperties(Request $request)
    {
        if ($request->query->has('city_name')) {
            if ($request->query->has('less_price')) {
                if ($request->query->has('filter')) {
                    $cities = City::all();
                    $property_facilities = PropertyFacility::all();
                    $property_types = PropertyType::all();
                    $room_sub_facilities = RoomSubFacilities::all();
                    $reservation_policies = ReservationPolicy::all();
                    $meal_types = MealsType::all();
                    $review_score = ReviewScore::all();

                    $input_city = $request->query('city_name');
                    $city = City::where('name', $input_city)->first();

                    $properties_list = $this->propertyRepository->allPropeties()->leftJoin('rooms', 'rooms.property_id', '=', 'properties.id')
                        ->leftJoin('sub_rooms', 'rooms.id', '=', 'sub_rooms.room_id');

                    $filter_array = ($request->query('filter'));

                    foreach ($filter_array as $key => $value) {
                        if (strcmp($key, 'star_rating') == 0) {
                            //dd( $value);
                            $star_rating_ids = explode(',', $value);
                            $properties_list = $properties_list
                                ->whereIn('star_rating', $star_rating_ids);
                        }
                        if (strcmp($key, 'property_facility') == 0) {
                            // dd($value);
                            $property_facility_array_ids = explode(',', $value);

                            $properties_list = $properties_list
                                ->leftJoin('property_has_facilities', 'properties.id', '=', 'property_has_facilities.property_id')
                                ->whereIn('property_facility_id', $property_facility_array_ids);
                        }
                        if (strcmp($key, 'property_type') == 0) {
                            //dd($value);
                            $property_type_array_ids = explode(',', $value);

                            $properties_list = $properties_list->whereIn('property_type_id', $property_type_array_ids);
                        }
                        if (strcmp($key, 'room_sub_facilities') == 0) {
                            //   dd($value);
                            $room_sub_facilities_array_ids = explode(',', $value);
                            //dd( $room_sub_facilities_array_ids);
                            $properties_list = $properties_list
                                ->leftJoin('room_has_sub_facilities', 'room_has_sub_facilities.room_id', '=', 'rooms.id')
                                ->whereIn('sub_facility_id', $room_sub_facilities_array_ids);
                        }
                        if (strcmp($key, 'reservation_policy') == 0) {
                            //   dd( $value);
                            $reservation_policy_ids = explode(',', $value);
                            $properties_list = $properties_list
                                ->leftJoin('sub_room_has_reservation_policy', 'sub_rooms.id', '=', 'sub_room_has_reservation_policy.sub_room_id')
                                ->whereIn('reservation_policy_id', $reservation_policy_ids);
                        }
                        if (strcmp($key, 'meal_type') == 0) {
                            //dd( $value);
                            $meal_types_ids = explode(',', $value);
                            $properties_list = $properties_list
                                ->leftJoin('sub_room_has_meals_type', 'sub_rooms.id', '=', 'sub_room_has_meals_type.sub_room_id')
                                ->whereIn('meal_type_id', $meal_types_ids);
                        }
                        if (strcmp($key, 'review_score') == 0) {
                            //dd( $value);
                            $review_score_ids = explode(',', $value);
                            $properties_list = $properties_list
                                ->whereIn('review_score_id', $review_score_ids);
                        }

                        // dump($key);
                        $filterd_properties = $properties_list->where('city_id', $city->id)
                            ->orderByRaw('ISNULL(rooms.minimum_rate), minimum_rate ASC')
                            ->select('properties.*')
                            ->distinct('properties.id')->paginate(10);
                    }

                    return view('home.property_list', [
                        'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                        'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                        'meal_types' => $meal_types, 'review_scores' => $review_score,
                    ]);
                } else {
                    $cities = City::all();
                    $property_facilities = PropertyFacility::all();
                    $property_types = PropertyType::all();
                    $room_sub_facilities = RoomSubFacilities::all();
                    $reservation_policies = ReservationPolicy::all();
                    $meal_types = MealsType::all();
                    $review_score = ReviewScore::all();

                    $input_city = $request->query('city_name');

                    $city = City::where('name', $input_city)->first();

                    $filterd_properties = $this->propertyRepository->allPropeties()->join('rooms', 'properties.id', '=', 'rooms.property_id')
                        ->where('city_id', $city->id)
                        ->orderByRaw('ISNULL(rooms.minimum_rate), minimum_rate ASC')
                        ->select('properties.*')
                        ->distinct('properties.id')
                        ->paginate(10);

                    return view('home.property_list', [
                        'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                        'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                        'meal_types' => $meal_types, 'review_scores' => $review_score,
                    ]);
                }
            } elseif ($request->query->has('most_rated')) {
            } elseif ($request->query->has('most_viewd')) {
                if ($request->query->has('filter')) {
                    $property_facilities = PropertyFacility::all();
                    $cities = City::all();
                    $property_types = PropertyType::all();
                    $room_sub_facilities = RoomSubFacilities::all();
                    $reservation_policies = ReservationPolicy::all();
                    $meal_types = MealsType::all();
                    $review_score = ReviewScore::all();

                    $input_city = $request->query('city_name');
                    $city = City::where('name', $input_city)->first();

                    $properties_list = $this->propertyRepository->allPropeties()->leftJoin('rooms', 'rooms.property_id', '=', 'properties.id')
                        ->leftJoin('sub_rooms', 'rooms.id', '=', 'sub_rooms.room_id');

                    $filter_array = ($request->query('filter'));

                    foreach ($filter_array as $key => $value) {
                        if (strcmp($key, 'star_rating') == 0) {
                            //dd( $value);
                            $star_rating_ids = explode(',', $value);
                            $properties_list = $properties_list
                                ->whereIn('star_rating', $star_rating_ids);
                        }
                        if (strcmp($key, 'property_facility') == 0) {
                            //dd($value);
                            $property_facility_array_ids = explode(',', $value);

                            $properties_list = $properties_list
                                ->leftJoin('property_has_facilities', 'properties.id', '=', 'property_has_facilities.property_id')
                                ->whereIn('property_facility_id', $property_facility_array_ids);
                        }
                        if (strcmp($key, 'property_type') == 0) {
                            //dd($value);
                            $property_type_array_ids = explode(',', $value);

                            $properties_list = $properties_list->whereIn('property_type_id', $property_type_array_ids);
                        }
                        if (strcmp($key, 'room_sub_facilities') == 0) {
                            //   dd($value);
                            $room_sub_facilities_array_ids = explode(',', $value);
                            //dd( $room_sub_facilities_array_ids);
                            $properties_list = $properties_list
                                ->leftJoin('room_has_sub_facilities', 'room_has_sub_facilities.room_id', '=', 'rooms.id')
                                ->whereIn('sub_facility_id', $room_sub_facilities_array_ids);
                        }
                        if (strcmp($key, 'reservation_policy') == 0) {
                            //   dd( $value);
                            $reservation_policy_ids = explode(',', $value);
                            $properties_list = $properties_list
                                ->leftJoin('sub_room_has_reservation_policy', 'sub_rooms.id', '=', 'sub_room_has_reservation_policy.sub_room_id')
                                ->whereIn('reservation_policy_id', $reservation_policy_ids);
                        }
                        if (strcmp($key, 'meal_type') == 0) {
                            //dd( $value);
                            $meal_types_ids = explode(',', $value);
                            $properties_list = $properties_list
                                ->leftJoin('sub_room_has_meals_type', 'sub_rooms.id', '=', 'sub_room_has_meals_type.sub_room_id')
                                ->whereIn('meal_type_id', $meal_types_ids);
                        }

                        if (strcmp($key, 'review_score') == 0) {
                            //dd( $value);
                            $review_score_ids = explode(',', $value);
                            $properties_list = $properties_list
                                ->whereIn('review_score_id', $review_score_ids);
                        }

                        // dump($key);
                        $filterd_properties = $properties_list->where('city_id', $city->id)
                            ->orderBy('property_clicks', 'DESC')
                            ->select('properties.*')
                            ->distinct('properties.id')->paginate(10);
                    }

                    return view('home.property_list', [
                        'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                        'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                        'meal_types' => $meal_types, 'review_scores' => $review_score,
                    ]);
                } else {
                    $property_facilities = PropertyFacility::all();
                    $cities = City::all();
                    $property_types = PropertyType::all();
                    $room_sub_facilities = RoomSubFacilities::all();
                    $reservation_policies = ReservationPolicy::all();
                    $meal_types = MealsType::all();
                    $review_score = ReviewScore::all();

                    $input_city = $request->query('city_name');
                    $city = City::where('name', $input_city)->first();
                    $filterd_properties = $this->propertyRepository->allPropeties()->where('city_id', $city->id)
                        ->orderBy('property_clicks', 'DESC')
                        ->paginate(10);

                    return view('home.property_list', [
                        'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                        'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                        'meal_types' => $meal_types, 'review_scores' => $review_score,
                    ]);
                }
            } elseif ($request->query->has('filter')) {
                // dd("ok");
                $property_facilities = PropertyFacility::all();
                $cities = City::all();
                $property_types = PropertyType::all();
                $room_sub_facilities = RoomSubFacilities::all();
                $reservation_policies = ReservationPolicy::all();
                $meal_types = MealsType::all();
                $review_score = ReviewScore::all();

                $input_city = $request->query('city_name');
                $city = City::where('name', $input_city)->first();

                $properties_list = $this->propertyRepository->allPropeties()->leftJoin('rooms', 'rooms.property_id', '=', 'properties.id')
                    ->leftJoin('sub_rooms', 'rooms.id', '=', 'sub_rooms.room_id');

                $filter_array = ($request->query('filter'));
                // dd($filter_array);
                foreach ($filter_array as $key => $value) {
                    if (strcmp($key, 'star_rating') == 0) {
                        //dd( $value);
                        $star_rating_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->whereIn('star_rating', $star_rating_ids);
                    }
                    if (strcmp($key, 'property_facility') == 0) {
                        //  dd($value);
                        $property_facility_array_ids = explode(',', $value);

                        $properties_list = $properties_list
                            ->leftJoin('property_has_facilities', 'properties.id', '=', 'property_has_facilities.property_id')
                            ->whereIn('property_facility_id', $property_facility_array_ids);
                    }
                    if (strcmp($key, 'property_type') == 0) {
                        $property_type_array_ids = explode(',', $value);

                        $properties_list = $properties_list->whereIn('property_type_id', $property_type_array_ids);
                    }
                    if (strcmp($key, 'room_sub_facilities') == 0) {
                        //   dd($value);
                        $room_sub_facilities_array_ids = explode(',', $value);
                        //dd( $room_sub_facilities_array_ids);
                        $properties_list = $properties_list
                            ->leftJoin('room_has_sub_facilities', 'room_has_sub_facilities.room_id', '=', 'rooms.id')
                            ->whereIn('sub_facility_id', $room_sub_facilities_array_ids);
                    }
                    if (strcmp($key, 'reservation_policy') == 0) {
                        //   dd( $value);
                        $reservation_policy_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->leftJoin('sub_room_has_reservation_policy', 'sub_rooms.id', '=', 'sub_room_has_reservation_policy.sub_room_id')
                            ->whereIn('reservation_policy_id', $reservation_policy_ids);
                    }
                    if (strcmp($key, 'meal_type') == 0) {
                        //dd( $value);
                        $meal_types_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->leftJoin('sub_room_has_meals_type', 'sub_rooms.id', '=', 'sub_room_has_meals_type.sub_room_id')
                            ->whereIn('meal_type_id', $meal_types_ids);
                    }
                    if (strcmp($key, 'review_score') == 0) {
                        //dd( $value);
                        $review_score_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->whereIn('review_score_id', $review_score_ids);
                    }

                    // dump($key);
                    $filterd_properties = $properties_list->where('city_id', $city->id)
                        ->select('properties.*')
                        ->distinct('properties.id')->paginate(10);
                }

                return view('home.property_list', [
                    'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                    'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                    'meal_types' => $meal_types, 'review_scores' => $review_score,
                ]);
            } else {
                //dd("done");
                $property_facilities = PropertyFacility::all();
                $cities = City::all();
                $property_types = PropertyType::all();
                $room_sub_facilities = RoomSubFacilities::all();
                $reservation_policies = ReservationPolicy::all();
                $meal_types = MealsType::all();
                $review_score = ReviewScore::all();

                $input_city = $request->query('city_name');
                $city = City::where('name', $input_city)->first();
                $filterd_properties = $this->propertyRepository->allPropeties()->where('city_id', $city->id)->paginate(6);

                return view('home.property_list', [
                    'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                    'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                    'meal_types' => $meal_types, 'review_scores' => $review_score,
                ]);
            }
        } elseif ($request->query->has('filter')) {
            if ($request->query->has('less_price')) {
                $cities = City::all();
                $property_facilities = PropertyFacility::all();
                $property_types = PropertyType::all();
                $room_sub_facilities = RoomSubFacilities::all();
                $reservation_policies = ReservationPolicy::all();
                $meal_types = MealsType::all();
                $review_score = ReviewScore::all();

                $input_city = $request->query('city_name');

                $properties_list = $this->propertyRepository->allPropeties()->leftJoin('rooms', 'rooms.property_id', '=', 'properties.id')
                    ->leftJoin('sub_rooms', 'rooms.id', '=', 'sub_rooms.room_id');

                $filter_array = ($request->query('filter'));

                foreach ($filter_array as $key => $value) {
                    if (strcmp($key, 'star_rating') == 0) {
                        //dd( $value);
                        $star_rating_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->whereIn('star_rating', $star_rating_ids);
                    }
                    if (strcmp($key, 'property_facility') == 0) {
                        // dd($value);
                        $property_facility_array_ids = explode(',', $value);

                        $properties_list = $properties_list
                            ->leftJoin('property_has_facilities', 'properties.id', '=', 'property_has_facilities.property_id')
                            ->whereIn('property_facility_id', $property_facility_array_ids);
                    }
                    if (strcmp($key, 'property_type') == 0) {
                        //dd($value);
                        $property_type_array_ids = explode(',', $value);

                        $properties_list = $properties_list->whereIn('property_type_id', $property_type_array_ids);
                    }
                    if (strcmp($key, 'room_sub_facilities') == 0) {
                        //   dd($value);
                        $room_sub_facilities_array_ids = explode(',', $value);
                        //dd( $room_sub_facilities_array_ids);
                        $properties_list = $properties_list
                            ->leftJoin('room_has_sub_facilities', 'room_has_sub_facilities.room_id', '=', 'rooms.id')
                            ->whereIn('sub_facility_id', $room_sub_facilities_array_ids);
                    }
                    if (strcmp($key, 'reservation_policy') == 0) {
                        //   dd( $value);
                        $reservation_policy_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->leftJoin('sub_room_has_reservation_policy', 'sub_rooms.id', '=', 'sub_room_has_reservation_policy.sub_room_id')
                            ->whereIn('reservation_policy_id', $reservation_policy_ids);
                    }
                    if (strcmp($key, 'meal_type') == 0) {
                        //dd( $value);
                        $meal_types_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->leftJoin('sub_room_has_meals_type', 'sub_rooms.id', '=', 'sub_room_has_meals_type.sub_room_id')
                            ->whereIn('meal_type_id', $meal_types_ids);
                    }
                    if (strcmp($key, 'review_score') == 0) {
                        //dd( $value);
                        $review_score_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->whereIn('review_score_id', $review_score_ids);
                    }

                    // dump($key);
                    $filterd_properties = $properties_list->orderByRaw('ISNULL(rooms.minimum_rate), minimum_rate ASC')
                        ->select('properties.*')
                        ->distinct('properties.id')->paginate(10);
                }

                return view('home.property_list', [
                    'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                    'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                    'meal_types' => $meal_types, 'review_scores' => $review_score,
                ]);
            } elseif ($request->query->has('most_viewd')) {
                $property_facilities = PropertyFacility::all();
                $cities = City::all();
                $property_types = PropertyType::all();
                $room_sub_facilities = RoomSubFacilities::all();
                $reservation_policies = ReservationPolicy::all();
                $meal_types = MealsType::all();
                $review_score = ReviewScore::all();

                $input_city = $request->query('city_name');

                $properties_list = $this->propertyRepository->allPropeties()->leftJoin('rooms', 'rooms.property_id', '=', 'properties.id')
                    ->leftJoin('sub_rooms', 'rooms.id', '=', 'sub_rooms.room_id');

                $filter_array = ($request->query('filter'));

                foreach ($filter_array as $key => $value) {
                    if (strcmp($key, 'star_rating') == 0) {
                        //dd( $value);
                        $star_rating_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->whereIn('star_rating', $star_rating_ids);
                    }
                    if (strcmp($key, 'property_facility') == 0) {
                        //dd($value);
                        $property_facility_array_ids = explode(',', $value);

                        $properties_list = $properties_list
                            ->leftJoin('property_has_facilities', 'properties.id', '=', 'property_has_facilities.property_id')
                            ->whereIn('property_facility_id', $property_facility_array_ids);
                    }
                    if (strcmp($key, 'property_type') == 0) {
                        //dd($value);
                        $property_type_array_ids = explode(',', $value);

                        $properties_list = $properties_list->whereIn('property_type_id', $property_type_array_ids);
                    }
                    if (strcmp($key, 'room_sub_facilities') == 0) {
                        //   dd($value);
                        $room_sub_facilities_array_ids = explode(',', $value);
                        //dd( $room_sub_facilities_array_ids);
                        $properties_list = $properties_list
                            ->leftJoin('room_has_sub_facilities', 'room_has_sub_facilities.room_id', '=', 'rooms.id')
                            ->whereIn('sub_facility_id', $room_sub_facilities_array_ids);
                    }
                    if (strcmp($key, 'reservation_policy') == 0) {
                        //   dd( $value);
                        $reservation_policy_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->leftJoin('sub_room_has_reservation_policy', 'sub_rooms.id', '=', 'sub_room_has_reservation_policy.sub_room_id')
                            ->whereIn('reservation_policy_id', $reservation_policy_ids);
                    }
                    if (strcmp($key, 'meal_type') == 0) {
                        //dd( $value);
                        $meal_types_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->leftJoin('sub_room_has_meals_type', 'sub_rooms.id', '=', 'sub_room_has_meals_type.sub_room_id')
                            ->whereIn('meal_type_id', $meal_types_ids);
                    }
                    if (strcmp($key, 'review_score') == 0) {
                        //dd( $value);
                        $review_score_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->whereIn('review_score_id', $review_score_ids);
                    }

                    // dump($key);
                    $filterd_properties = $properties_list->orderBy('property_clicks', 'DESC')
                        ->select('properties.*')
                        ->distinct('properties.id')->paginate(10);
                }

                return view('home.property_list', [
                    'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                    'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                    'meal_types' => $meal_types, 'review_scores' => $review_score,
                ]);
            } else {
                $property_facilities = PropertyFacility::all();
                $cities = City::all();
                $property_types = PropertyType::all();
                $room_sub_facilities = RoomSubFacilities::all();
                $reservation_policies = ReservationPolicy::all();
                $meal_types = MealsType::all();
                $review_score = ReviewScore::all();

                $properties_list = $this->propertyRepository->allPropeties()->leftJoin('rooms', 'rooms.property_id', '=', 'properties.id')
                    ->leftJoin('sub_rooms', 'rooms.id', '=', 'sub_rooms.room_id');

                $filter_array = ($request->query('filter'));
                foreach ($filter_array as $key => $value) {
                    if (strcmp($key, 'star_rating') == 0) {
                        //dd( $value);
                        $star_rating_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->whereIn('star_rating', $star_rating_ids);
                    }
                    if (strcmp($key, 'property_facility') == 0) {
                        //  dd($value);
                        $property_facility_array_ids = explode(',', $value);

                        $properties_list = $properties_list
                            ->leftJoin('property_has_facilities', 'properties.id', '=', 'property_has_facilities.property_id')
                            ->whereIn('property_facility_id', $property_facility_array_ids);
                    }
                    if (strcmp($key, 'property_type') == 0) {
                        //dd($value);
                        $property_type_array_ids = explode(',', $value);

                        $properties_list = $properties_list->whereIn('property_type_id', $property_type_array_ids);
                    }
                    if (strcmp($key, 'room_sub_facilities') == 0) {
                        //   dd($value);
                        $room_sub_facilities_array_ids = explode(',', $value);
                        //dd( $room_sub_facilities_array_ids);
                        $properties_list = $properties_list
                            ->leftJoin('room_has_sub_facilities', 'room_has_sub_facilities.room_id', '=', 'rooms.id')
                            ->whereIn('sub_facility_id', $room_sub_facilities_array_ids);
                    }
                    if (strcmp($key, 'reservation_policy') == 0) {
                        //   dd( $value);
                        $reservation_policy_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->leftJoin('sub_room_has_reservation_policy', 'sub_rooms.id', '=', 'sub_room_has_reservation_policy.sub_room_id')
                            ->whereIn('reservation_policy_id', $reservation_policy_ids);
                    }
                    if (strcmp($key, 'meal_type') == 0) {
                        //dd( $value);
                        $meal_types_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->leftJoin('sub_room_has_meals_type', 'sub_rooms.id', '=', 'sub_room_has_meals_type.sub_room_id')
                            ->whereIn('meal_type_id', $meal_types_ids);
                    }
                    if (strcmp($key, 'review_score') == 0) {
                        //dd( $value);
                        $review_score_ids = explode(',', $value);
                        $properties_list = $properties_list
                            ->whereIn('review_score_id', $review_score_ids);
                    }
                    // dump($key);
                    $filterd_properties = $properties_list->select('properties.*')
                        ->distinct('properties.id')->paginate(10);
                }

                return view('home.property_list', [
                    'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                    'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                    'meal_types' => $meal_types, 'review_scores' => $review_score,
                ]);
            }
        } else {
            if ($request->query->has('less_price')) {
                $cities = City::all();
                $property_facilities = PropertyFacility::all();
                $property_types = PropertyType::all();
                $room_sub_facilities = RoomSubFacilities::all();
                $reservation_policies = ReservationPolicy::all();
                $meal_types = MealsType::all();
                $review_score = ReviewScore::all();

                $filterd_properties = $this->propertyRepository->allPropeties()->join('rooms', 'properties.id', '=', 'rooms.property_id')
                    ->orderByRaw('ISNULL(rooms.minimum_rate), minimum_rate ASC')
                    ->select('properties.*')
                    ->distinct('properties.id')
                    ->paginate(10);

                return view('home.property_list', [
                    'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                    'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                    'meal_types' => $meal_types, 'review_scores' => $review_score,
                ]);
            } elseif ($request->query->has('most_viewd')) {
                $property_facilities = PropertyFacility::all();
                $cities = City::all();
                $property_types = PropertyType::all();
                $room_sub_facilities = RoomSubFacilities::all();
                $reservation_policies = ReservationPolicy::all();
                $meal_types = MealsType::all();
                $review_score = ReviewScore::all();

                $filterd_properties = $this->propertyRepository->allPropeties()->orderBy('property_clicks', 'DESC')->paginate(10);

                return view('home.property_list', [
                    'properties' => $filterd_properties, 'cities' => $cities, 'property_facilities' => $property_facilities,
                    'property_types' => $property_types, 'room_sub_facilities' => $room_sub_facilities, 'reservation_policies' => $reservation_policies,
                    'meal_types' => $meal_types, 'review_scores' => $review_score,
                ]);
            }
        }
    }

    public function showBookingLogin($property_id)
    {
        $property = $this->propertyRepository->findProperty($property_id);

        return view('home.validate_bookingid', ['properties' => $property]);
    }

    public function showAddReviews(Request $request)
    {
        $booking_number = $request->input('bookingNumber');
        $booking = Booking::where('id', '=', $booking_number)->first();

        if ($booking === null) {
            $res['success'] = false;
            $res['bookingNumber'] = $booking_number;
            $res['message'] = 'Please Enter Valid Booking Number';

            return response()->json($res);
        }

        $property_review_count = PropertyReview::where('booking_id', $booking->id)->count();

        if ($booking->property_id != $request->input('property_id')) {
            $res['success'] = false;
            $res['message'] = 'Entered Booking Number and Hotel does not match';

            return response($res);
        } elseif ($property_review_count != 0) {
            $res['success'] = false;
            $res['message'] = 'Your Review is already marked';

            return response($res);
        } else {
            $property = $this->propertyRepository->findProperty($request->input('property_id'));
            $review_category = ReviewCategory::all();
            $review_guest_type = ReviewGuestType::all();

            $res['success'] = true;
            $res['status'] = 1;
            $res['bookingNumber'] = $booking_number;

            return response($res);
        }
    }

    public function saveReviews(Request $request)
    {
        $property_id = $request->input('property_id');
        $user = auth()->user()->id;

        $review_guest_type = $request->input('review_guest_type');
        $description = $request->input('description');
        $title = $request->input('title');
        $rate1 = $request->input('1');
        $rate2 = $request->input('2');
        $rate3 = $request->input('3');
        $rate4 = $request->input('4');
        $rate5 = $request->input('5');
        $rate6 = $request->input('6');
        $rate7 = $request->input('7');
        $rates = [$rate1, $rate2, $rate3, $rate4, $rate5, $rate6, $rate7];

        $property_review = new PropertyReview;
        $property_review->review_guest_type_id = $review_guest_type;
        $property_review->description = $description;
        $property_review->title = $title;
        $property_review->property_id = $property_id;
        $property_review->user_id = $user;
        $property_review->booking_id = $request->input('booking_id');
        $property_review->save();
        $property_review_id = $property_review->id;

        $this->calculatePropertyReviewScore($property_id);

        $review_categories = ReviewCategory::all();
        foreach ($review_categories  as $key => $review_category) {
            $review_has_review_category = new ReviewHasReviewCategory;
            $review_has_review_category->review_id = $property_review_id;
            $review_has_review_category->review_category_id = $review_category->id;
            $review_has_review_category->rating = $rates[$key];
            $review_has_review_category->save();
        }

        $overall_score = DB::table('review_has_review_categories')
            ->select(DB::raw('AVG(rating) as avg_rating'))
            ->where('review_id', $property_review_id)
            ->groupBy('review_id')
            ->first();

        $property_review = PropertyReview::find($property_review_id);
        $property_review->overall_score = $overall_score->avg_rating;
        $property_review->save();

        $res['success'] = true;
        $res['message'] = 'Review Added successfully!';

        return response($res);
    }

    // public function checkAvailability(Request $request)
    // {
    //     // dump($request->all());
    //     $date_range = $request->input('dates');
    //     $dates = explode(" - ",$date_range);
    //     $property_id = $request->input('property_id');
    //     $property = Property::where('id',$property_id)->first();
    //     // dump($dates);

    //     $filtered_rooms = [];

    //     $rooms = $property->rooms;
    //     foreach($rooms as $room){
    //         $availability_checks = AvailabilityRoomStatus::where('room_id',$room->id)->get();

    //         foreach($availability_checks as $check){
    //             $new_date = date('m/d/Y', strtotime($check->date));
    //             if((!in_array($new_date, $dates))){

    //                 $availability_rate_check = AvailabilityRoomRate::where('room_id',$room->id)->get();
    //                 $filtered_rooms[] = $room;
    //             }
    //         }
    //     }
    //     dump($rooms);
    //     dd($filtered_rooms);
    // }

    public function checkAvailability(Request $request)
    {
        dd($request->query('dates'));
    }

    private function removeTimeFromDate(string $date): string
    {
        $dt = new DateTime($date);

        return $dt->format('Y-m-d');
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
