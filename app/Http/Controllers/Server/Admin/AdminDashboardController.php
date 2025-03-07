<?php

namespace App\Http\Controllers\Server\Admin;

use App\Enums\RoleType;
//use App\Http\Resources\API\v1\User;
use App\Http\Controllers\Controller;
use App\Models\BedType;
use App\Models\City;
use App\Models\CreditCard;
use App\Models\District;
use App\Models\MealsType;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Models\PropertyHasFacility;
use App\Models\PropertyHasReviewCategory;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\ReservationPolicy;
use App\Models\ReviewCategory;
use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomHasFacility;
use App\Models\RoomHasSubFacilities;
use App\Models\RoomHasUnit;
use App\Models\RoomImage;
use App\Models\RoomKeyFacilities;
use App\Models\RoomSubFacilities;
use App\Models\RoomType;
use App\Models\SubRoomHasMealsType;
use App\Models\SubRoomHasReservationPolicy;
use App\Models\SubRooms;
use App\Models\Unit;
use App\Models\UnitHasBedType;
use App\Models\User;
use App\Repository\PropertyRepositoryInterface;
use App\Traits\CalculateMiniumRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Size;
use Symfony\Component\Console\Input\Input;

class AdminDashboardController extends Controller
{
    use CalculateMiniumRate;

    private PropertyRepositoryInterface $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function index()
    {
        return view('account.admin.dashboard');
    }

    public function showAddProperty()
    {
        $user = User::role(RoleType::PROPERTY_OWNER)->get();
        $property_facility = PropertyFacility::all();
        $district = District::all();
        $city = City::all();
        $property_type = PropertyType::all();

        return view('account.admin.properties.add', ['cities' => $city, 'districts' => $district, 'users' => $user, 'property_facility' => $property_facility, 'property_types' => $property_type]);
    }

    public function saveProperty(Request $request)
    {
        $property_id = $this->propertyRepository->createProperty($request->only($this->propertyRepository->getModel()->fillable));

        $property_facilities = $request->input('property_facility');
        if ($request->hasfile('sub_images')) {
            foreach ($request->sub_images as $sub_image) {
                $file_e = File::extension($sub_image->getClientOriginalName());
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

        foreach ($property_facilities as $property_facilitity) {
            DB::table('property_has_facilities')->insert([
                'property_id' => $property_id,
                'property_facility_id' => $property_facilitity,
            ]);
        }
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

    public function showAllProperty()
    {
        $property = Property::all();

        return view('account.admin.properties.all', ['properties' => $property]);
    }

    public function updatePropertyStatus(Request $request, $property_id)
    {
        $this->propertyRepository->chagePropertyStatus($property_id, $request->boolean('switchStatus'));

        $res['success'] = true;
        $res['message'] = 'property updated successfully!';

        return response($res);
    }

    public function showEditProperty($id)
    {
        $user = User::role(RoleType::PROPERTY_OWNER)->get();
        $property = Property::find($id);
        $district = District::all();
        $city = City::all();
        $room = Room::all()->where('property_id', '=', $id);
        $property_facility = PropertyFacility::all();
        $property_has_facility = $property->facilities->pluck('id')->toArray();
        $property_type = PropertyType::all();

        return view('account.admin.properties.edit', ['properties' => $property, 'rooms' => $room, 'districts' => $district, 'cities' => $city, 'users' => $user, 'property_facilities' => $property_facility, 'property_has_facilities' => $property_has_facility, 'property_types' => $property_type]);
    }

    public function updateProperty(Request $request, $property_id)
    {
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
        $property_facilities = $request->input('Property_facility');

        if (! empty($main_image)) {
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

        $res['success'] = true;
        $res['message'] = 'property Updated successfully!';

        return response($res);
    }

    public function deleteProperty($property_id)
    {
        $property = Property::find($property_id);
        $property->delete();

        return redirect('admin/properties/all');
    }

    public function showAddRoom($id)
    {
        $items = [];
        $property = Property::find($id);
        $facility = RoomFacility::all();
        //dd($);
        $room_type = RoomType::all();

        return view('account.admin.rooms.add', ['properties' => $property, 'room_types' => $room_type, 'facility' => $facility]);
    }

    public function showSubFacilities(Request $request)
    {
        //   dd($facility);
        $facility_id = $request->input('property_facility_id');
        $facility_id_array = explode(',', $facility_id);
        //dd($facility_id_array);
        for ($i = 0; $i < count($facility_id_array); $i++) {
            //dump($facility_id_array[$i]);
            $new_facility_id = $facility_id_array[$i];
            $items[] = RoomSubFacilities::where('facility_id', $new_facility_id)->get();
        }
        //  dd($cars);

        $sub_facilities = RoomSubFacilities::where('facility_id', $facility_id)->get();
        // dd($sub_facilities);

        return response()->json($items);
    }

    public function saveRoom(Request $request, $id)
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
        $room->property_id = $id;

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

    public function showUpdateRoom($id, $room_id)
    {
        $property = Property::find($id);
        $room = Room::find($room_id);
        $room_type = RoomType::all();
        $bed_types = BedType::all();
        $facility = RoomFacility::all();
        $meal_types = MealsType::all();
        $sub_rooms = SubRooms::where('room_id', $room_id)->get();
        $room_has_facility = RoomHasFacility::all()->where('room_id', '=', $room_id);

        $unit = DB::table('room_has_unit')
            ->join('rooms', 'room_has_unit.room_id', '=', 'rooms.id')
            ->join('units', 'room_has_unit.unit_id', '=', 'units.id')
            ->select('units.*')
            ->where('room_has_unit.room_id', '=', $room_id)
            ->get();

        $resvation_policies = ReservationPolicy::all();

        return view('account.admin.rooms.edit', ['rooms' => $room, 'properties' => $property, 'room_types' => $room_type, 'facility' => $facility, 'meal_types' => $meal_types, 'resvation_policies' => $resvation_policies, 'sub_rooms' => $sub_rooms, 'units' => $unit, 'bed_types' => $bed_types]);
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

    public function deleteRoom($id, $room_id)
    {
        $room = Room::find($room_id);
        $room->delete();

        return Redirect::back();
    }

    public function UpdateRoom(Request $request, $id, $room_id)
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
        $room->property_id = $id;
        $room->save();

        $room_id = $room_id;

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
        $res['message'] = 'Room update successfully!';

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

    public function SaveSubRoom(Request $request, $property_id, $room_id)
    {
        $sleep_type_id = $request->input('sleep_type_id');
        $meal_type_ids = $request->input('meal_type_ids');
        $sub_room_rate = $request->input('rate');
        $resvation_policy_ids = $request->input('resvation_policy_ids');
        $sub_room = new SubRooms;
        $sub_room->room_id = $room_id;
        $sub_room->sleep_type_id = $sleep_type_id;
        $sub_room->rate = $sub_room_rate;
        $sub_room->save();

        $sub_room_id = $sub_room->id;

        $this->calculateMiniumRateOne($property_id, $room_id, $sub_room_rate);

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

    public function UpdateSubRoom(Request $request, $property_id, $room_id, $sub_room_id)
    {
        //dd($sub_room_id);
        $sleep_type_id = $request->input('sleep_type_id');
        $meal_type_ids = $request->input('meal_type_ids');
        $sub_room_rate = $request->input('rate');
        $resvation_policy_ids = $request->input('resvation_policy_ids');
        // dd($resvation_policy_ids);
        $sub_room = SubRooms::find($sub_room_id);
        $sub_room->sleep_type_id = $sleep_type_id;
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
        //dd("stop");
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

    public function deleteSubRoom($id, $room_id, $sub_room_id)
    {
        $sub_room = SubRooms::find($sub_room_id);
        $sub_room->delete();

        return Redirect::back();
    }

    public function deleteUnitRoom($id, $room_id, $unit_id)
    {
        $unit = Unit::find($unit_id);
        $unit->delete();

        return Redirect::back();
    }

    public function showAddBooking()
    {
        return view('account.admin.booking.add');
    }

    public function showAllBooking()
    {
        return view('account.admin.booking.all');
    }

    public function showLocations()
    {
        $provinces = Province::all();
        $districts = District::all();
        $cities = City::all();

        return view('account.admin.system_settings.locations.index', ['provinces' => $provinces, 'districts' => $districts, 'cities' => $cities]);
    }

    public function saveProvince(Request $request)
    {
        $name = $request->input('province_name');

        $province = new Province;
        // dd($province);
        $province->name = $name;
        $province->save();

        $res['success'] = true;
        $res['message'] = 'Province Added successfully!';

        return response($res);
    }

    public function deleteProvince($province_id)
    {
        $province = Province::find($province_id);
        $province->delete();

        $res['success'] = false;
        $res['message'] = 'Province has been Deleted!!';

        return response($res);
    }

    public function updateProvince(Request $request, $province_id)
    {
        $name = $request->input('province_name');

        $province = Province::find($province_id);
        //dd($province);
        $province->name = $name;
        $province->save();

        $res['success'] = true;
        $res['message'] = 'Province has been Updated!';

        return response($res);
    }

    public function saveDistrict(Request $request)
    {
        $district_name = $request->input('district_name');
        $province_id = $request->input('province_id');
        $district = new District;
        $district->name = $district_name;
        $district->province_id = $province_id;
        $district->save();

        // $link = url('/admin/system_settings/locations') . '#tab2';
        $res['success'] = true;
        $res['message'] = 'District Added successfully!';

        return response($res);
    }

    public function deleteDistrict($id)
    {
        $district = District::find($id);
        $district->delete();

        $res['success'] = false;
        $res['message'] = 'District has been Deleted!!';

        return response($res);
    }

    public function updateDistrict(Request $request, $id)
    {
        $district_name = $request->input('district_name');
        $province_id = $request->input('province_id');

        $district = District::find($id);
        $district->name = $district_name;
        $district->province_id = $province_id;
        $district->save();

        $res['success'] = true;
        $res['message'] = 'District has been Updated!';

        return response($res);
    }

    public function saveCity(request $request)
    {
        $city_name = $request->input('city_name');
        $district_id = $request->input('district_id');
        $city = new City;
        $city->name = $city_name;
        $city->district_id = $district_id;
        $city->save();

        $res['success'] = true;
        $res['message'] = 'City Added successfully!';

        return response($res);
    }

    public function deleteCity($id)
    {
        $city = City::find($id);
        $city->delete();

        $res['success'] = false;
        $res['message'] = 'City has been Deleted!!';

        return response($res);
    }

    public function updateCity(Request $request, $id)
    {
        $city_name = $request->input('city_name');
        $district_id = $request->input('district_id');

        $city = City::find($id);
        $city->name = $city_name;
        $city->district_id = $district_id;
        $city->save();

        $res['success'] = true;
        $res['message'] = 'City has been Updated!';

        return response($res);
    }

    public function showRoomFacilities()
    {
        $key_facility = RoomKeyFacilities::all();
        $room_facility = RoomFacility::all();
        $sub_facility = RoomSubFacilities::all();

        return view('account.admin.system_settings.room_facilities.index', ['keyFacilities' => $key_facility, 'roomFacilities' => $room_facility, 'subFacilities' => $sub_facility]);
    }

    public function saveKeyFacility(Request $request)
    {
        $key_facility_name = $request->input('key_facility_name');
        $key_facility = new RoomKeyFacilities;
        $key_facility->name = $key_facility_name;
        $key_facility->save();

        $res['success'] = true;
        $res['message'] = 'Key Facility Added successfully!';

        return response($res);
    }

    public function updateKeyFacilities(Request $request, $id)
    {
        $key_facility_name = $request->input('key_facility_name');

        $key_facility = RoomKeyFacilities::find($id);
        // dd($key_facility);
        $key_facility->name = $key_facility_name;
        $key_facility->save();

        $res['success'] = true;
        $res['message'] = 'Key faclities has been updated';

        return response($res);
    }

    public function deleteKeyFacilities($id)
    {
        $delete_Key_Facilities = RoomKeyFacilities::find($id);
        //dd($delete_Key_Facilities);
        $delete_Key_Facilities->delete();

        $res['success'] = false;
        $res['message'] = 'Key faclities has been deleted';

        return response($res);
    }

    public function saveRoomFacility(Request $request)
    {
        $room_facility_name = $request->input('facility_name');
        $facility_description = $request->input('facility_description');

        $facility = new RoomFacility;
        $facility->name = $room_facility_name;
        $facility->description = $facility_description;
        $facility->save();

        $res['success'] = true;
        $res['message'] = ' Facility Added successfully!';

        return response($res);
    }

    public function updateRoomFacilities(Request $request, $id)
    {
        $room_facility_name = $request->input('facility_name');
        $room_facility_description = $request->input('facility_description');

        $room_facility = RoomFacility::find($id);
        // dd($room_facility);
        $room_facility->name = $room_facility_name;
        $room_facility->description = $room_facility_description;
        $room_facility->save();

        $res['success'] = true;
        $res['message'] = 'Room facilities has been updated';

        return response($res);
    }

    public function deleteRoomFacilities($id)
    {
        $delete_Room_Facilities = RoomFacility::find($id);
        //dd($delete_Room_Facilities);
        $delete_Room_Facilities->delete();

        $res['success'] = false;
        $res['message'] = 'Room faclities has been deleted';

        return response($res);
    }

    public function saveRoomSubFacilities(Request $request)
    {
        $sub_facility_name = $request->input('sub_facility_name');
        $sub_facility = new RoomSubFacilities;
        $sub_facility->name = $sub_facility_name;
        $sub_facility->save();

        $res['success'] = true;
        $res['message'] = 'Sub Facility Added successfully!';

        return response($res);
    }

    public function updateSubFacilities(Request $request, $id)
    {
        $sub_facility_name = $request->input('sub_facility_name');

        $sub_facility = RoomSubFacilities::find($id);
        $sub_facility->name = $sub_facility_name;
        $sub_facility->save();

        $res['success'] = true;
        $res['message'] = 'Sub faclities has been Updated';

        return response($res);
    }

    public function deleteSubFacilities($id)
    {
        $delete_Sub_Facilities = RoomSubFacilities::find($id);
        //dd($delete_Sub_Facilities);
        $delete_Sub_Facilities->delete();

        $res['success'] = false;
        $res['message'] = 'Sub faclities has been Deleted';

        return response($res);
    }

    public function showPropertyFacilities()
    {
        $property_facility = PropertyFacility::all();

        return view('account.admin.system_settings.property_facilities.index', ['property_facilities' => $property_facility]);
    }

    public function savePropertyFacility(Request $request)
    {
        $property_facility_name = $request->input('property_facility_name');
        $property_facility_description = $request->input('property_facility_description');

        $property_facility = new PropertyFacility;

        $property_facility->name = $property_facility_name;
        $property_facility->description = $property_facility_description;
        $property_facility->save();

        return response(['success' => true, 'message' => 'property Facility Added Successful']);
    }

    public function updatePropertyFacilities(Request $request, $id)
    {
        $property_facility = $request->input('property_facility_name');
        $property_description = $request->input('property_facility_description');
        $facility = PropertyFacility::find($id);
        //dd($facility);
        $facility->name = $property_facility;
        $facility->description = $property_description;
        $facility->save();

        $res['success'] = true;
        $res['message'] = 'property faclities has been updated';

        return response($res);
    }

    public function deletePropertyFacilities($id)
    {
        $property_facility_delete = PropertyFacility::find($id);
        $property_facility_delete->delete();

        $res['success'] = false;
        $res['message'] = 'property faclities has been deleted';

        return response($res);
    }

    public function showRoomType()
    {
        $room_type = RoomType::all();

        return view('account.admin.system_settings.room_type.index', ['room_types' => $room_type]);
    }

    public function saveRoomType(Request $request)
    {
        $room_type = new RoomType;

        $room_type_name = $request->input('room_type');
        $room_type_description = $request->input('room_type_description');

        $room_type->type = $room_type_name;
        $room_type->description = $room_type_description;

        $room_type->save();

        $res['success'] = true;
        $res['message'] = 'Room Type Added successfully!';

        return response($res);
    }

    public function updateRoomType(Request $request, $id)
    {
        $room_type_name = $request->input('room_type');
        $room_type_description = $request->input('room_type_description');

        $room_type = RoomType::find($id);
        $room_type->type = $room_type_name;
        $room_type->description = $room_type_description;
        $room_type->save();

        $res['success'] = true;
        $res['message'] = 'Room Type has been updated';

        return response($res);
    }

    public function deleteRoomType($id)
    {
        $delete_Room_Type = RoomType::find($id);
        $delete_Room_Type->delete();

        $res['success'] = false;
        $res['message'] = 'Room Type has been deleted';

        return response($res);
    }

    public function showPropertyType()
    {
        $property_type = PropertyType::all();

        return view('account.admin.system_settings.property_type.index', ['property_types' => $property_type]);
    }

    public function savePropertyType(Request $request)
    {
        $type = $request->input('property_type');
        $property_type = new PropertyType;
        $property_type->type = $type;
        $property_type->save();

        $res['success'] = true;
        $res['message'] = 'Property Type Added successfully!';

        return response($res);
    }

    public function updatePropertyType(Request $request, $property_type_id)
    {
        $type = $request->input('property_type');
        $property_type = PropertyType::find($property_type_id);
        $property_type->type = $type;
        $property_type->save();

        $res['success'] = true;
        $res['message'] = 'Property Type Updated successfully!';

        return response($res);
    }

    public function deletePropertyType($property_type_id)
    {
        $property_type = PropertyType::find($property_type_id);
        $property_type->delete();

        $res['success'] = false;
        $res['message'] = 'Property Type Deleted successfully!';

        return response($res);
    }

    public function showBedType()
    {
        $bed_type = BedType::all();

        return view('account.admin.system_settings.bed_type.index', ['bed_types' => $bed_type]);
    }

    public function saveBedType(Request $request)
    {
        $type = $request->input('bed_type');
        $capacity = $request->input('bed_capacity');
        $icon = $request->input('bed_icon');

        $bed_type = new BedType;
        $bed_type->type = $type;
        $bed_type->capacity = $capacity;
        $bed_type->icon = $icon;
        $bed_type->save();

        $res['success'] = true;
        $res['message'] = 'Property Type Added successfully!';

        return response($res);
    }

    public function updateBedType(Request $request, $bed_type_id)
    {
        $type = $request->input('bed_type');
        $capacity = $request->input('bed_capacity');
        $icon = $request->input('bed_icon');

        $bed_type = BedType::find($bed_type_id);
        $bed_type->type = $type;
        $bed_type->capacity = $capacity;
        $bed_type->icon = $icon;
        $bed_type->save();

        $res['success'] = true;
        $res['message'] = 'Property Type Updated successfully!';

        return response($res);
    }

    public function deleteBedType($bed_type_id)
    {
        $bed_type = BedType::find($bed_type_id);
        $bed_type->delete();

        $res['success'] = false;
        $res['message'] = 'Property Type Deleted successfully!';

        return response($res);
    }

    public function showCreditCardType()
    {
        $credit_card = CreditCard::all();

        return view('account.admin.system_settings.credit_card.index', ['credit_cards' => $credit_card]);
    }

    public function saveCreditCardType(Request $request)
    {
        $credit_card_type = $request->input('card_type');
        $credit_card_img = $request->file('input_img');

        $credit_card = new CreditCard;
        $credit_card->card_type = $credit_card_type;

        if (! empty($credit_card_img)) {
            $file_ex = strtolower(File::extension($credit_card_img->getClientOriginalName()));
            //dd($file_ex);
            if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif' && $file_ex != 'pdf') {
                $res['success'] = false;
                $res['message'] = 'Invalid photo type!';

                return response($res);
            }
            $filename = uniqid() . '.' . $file_ex;
            $credit_card_img->storeAs('public/credit_card_image', $filename);
            $credit_card->credit_card_image = $filename;
        } else {
            $credit_card->credit_card_image = null;
        }
        $credit_card->save();

        $res['success'] = true;
        $res['message'] = 'Credit Card Type Added successfully!';

        return response($res);
    }

    public function showEditCreditCardType($credit_card_id)
    {
        $credit_cards = CreditCard::find($credit_card_id);

        return view('account.admin.system_settings.credit_card.edit', ['credit_cards' => $credit_cards]);
    }

    public function updateCreditCardType(Request $request, $credit_card_id)
    {
        $credit_card_type = $request->input('card_type');
        $credit_card_img = $request->file('input_img');

        $credit_card = CreditCard::find($credit_card_id);
        $credit_card->card_type = $credit_card_type;

        if (! empty($credit_card_img)) {
            $file_ex = strtolower(File::extension($credit_card_img->getClientOriginalName()));
            //dd($file_ex);
            if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif' && $file_ex != 'pdf') {
                $res['success'] = false;
                $res['message'] = 'Invalid photo type!';

                return response($res);
            }
            $filename = uniqid() . '.' . $file_ex;
            $credit_card_img->storeAs('public/credit_card_image', $filename);
            $credit_card->credit_card_image = $filename;
        } else {
            $credit_card->credit_card_image = null;
        }
        $credit_card->save();

        $res['success'] = true;
        $res['message'] = 'Credit Card Type Updated successfully!';

        return response($res);
    }

    public function deleteCreditCardType($credit_card_id)
    {
        $credit_card = CreditCard::find($credit_card_id);
        $credit_card->delete();

        $res['success'] = false;
        $res['message'] = 'Credit Card Type Deleted successfully!';

        return response($res);
    }

    public function showAddPropertyOwner()
    {
        return view('account/admin/property_owner/add');
    }

    public function showAllPropertyOwner()
    {
        $user = User::role('property-owner')->get();
        //dd($user);
        return view('account.admin.property_owner.all', ['users' => $user]);
    }

    public function showEditPropertyOwner($owner_id)
    {
        $user = User::find($owner_id);
        //dd($user);
        return view('account.admin.property_owner.edit', ['user' => $user]);
    }

    public function updatePropertyOwner(Request $request)
    {
        // dump($request->all());
        $owner_id = $request->input('owner_id');
        $user = User::find($owner_id);
        // dd($user);
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $username = $request->input('username');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $status = $request->input('status');
        $password = $request->input('password');

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'required',
        ]);
        // if($first_name || $last_name || $username || $email || $phone) {
        //     if($password) {
        //         $user->password = Hash::make($password);
        //     }
        //     $user->save();

        //     $res['success'] = true;
        //     $res['message'] = 'property Owner update successfully!';
        //     return response($res);
        // }
        // else {
        //     $res['false'] = true;
        //     $res['message'] = 'enter all required fields!';
        //     return response($res);
        // }

        if ($validated) {
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->username = $username;
            $user->email = $email;
            $user->phone = $phone;
            $user->is_blocked = $status;

            if ($password) {
                $user->password = Hash::make($password);
            }
            $user->save();

            $res['success'] = true;
            $res['message'] = 'property Owner update successfully!';

            return response($res);
        } else {
            $res['false'] = true;
            $res['message'] = 'enter all required fields!';

            return response($res);
        }

        //dd($user);
    }

    public function savePropertyOwner(Request $request)
    {
        $request->validate([
            'first_name' => ['bail', 'required', 'string'],
            'last_name' => ['bail', 'required', 'max:20', 'string'],
            'username' => ['bail', 'required', 'max:20', 'string'],
            'email' => ['bail', 'required', 'email', 'unique:users'],
            'phone' => ['bail', 'required', 'max:20'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],

        ]);
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password'));
        $user->assignRole(RoleType::PROPERTY_OWNER);
        //dd( $user);
        $user->save();

        $res['success'] = true;
        $res['message'] = 'property Owner Added successfully!';

        return response($res);
    }

    public function DeletePropertyOwner($id)
    {
        $user = User::find($id);
        // dd($user);
        $user->delete();

        return redirect('admin/property_owner/all');
    }

    public function showAddOffer()
    {
    }

    public function saveOffer()
    {
    }

    public function showAllOffer()
    {
    }

    public function showPropertyOwnerDetails()
    {
        $user = User::role(RoleType::PROPERTY_OWNER)->get();

        return view('account.admin.user_management.property_owner.details', ['users' => $user]);
    }

    public function updatePropertyOwnerStatus(Request $request, $user_id)
    {
        $property_owner_details = User::find($user_id);
        $property_owner_details->is_blocked = $request->boolean('switchStatus');
        $property_owner_details->save();

        $res['success'] = true;
        $res['message'] = 'property Owner Status Updated successfully!';

        return response($res);
    }

    public function showEditPropertyOwnerDetails($user_id)
    {
        $property_owner_detail = User::find($user_id);

        return view('account.admin.user_management.property_owner.edit', ['property_owner_details' => $property_owner_detail]);
    }

    public function updatePropertyOwnerDetails(Request $request, $user_id)
    {
        $property_owner_details = User::find($user_id);

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $contact_number = $request->input('phone');
        $user_name = $request->input('user_name');
        $email = $request->input('email');

        $property_owner_details->first_name = $first_name;
        $property_owner_details->last_name = $last_name;
        $property_owner_details->phone = $contact_number;
        $property_owner_details->username = $user_name;
        $property_owner_details->email = $email;
        $property_owner_details->save();

        $res['success'] = true;
        $res['message'] = 'property Owner Details Updated successfully!';

        return response($res);
    }

    public function deletePropertyOwnerDetails($user_id)
    {
        $property_owner_details = User::find($user_id);
        $property_owner_details->delete();

        return redirect('admin/user_management/property_owner/details');
    }

    public function showCustomerDetails()
    {
        $user = User::role(RoleType::CUSTOMER)->get();

        return view('account.admin.user_management.customer.details', ['users' => $user]);
    }

    public function updateCustomerStatus(Request $request, $user_id)
    {
        $customer = User::find($user_id);
        $customer->is_blocked = $request->boolean('switchStatus');
        $customer->save();

        $res['success'] = true;
        $res['message'] = 'Customer Status Updated successfully!';

        return response($res);
    }

    public function showEditCustomerDetails($user_id)
    {
        $customer_detail = User::find($user_id);

        return view('account.admin.user_management.customer.edit', ['customer_details' => $customer_detail]);
    }

    public function updateCustomerDetails(Request $request, $user_id)
    {
        $customer_details = User::find($user_id);

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $contact_number = $request->input('phone');
        $user_name = $request->input('user_name');
        $email = $request->input('email');

        $customer_details->first_name = $first_name;
        $customer_details->last_name = $last_name;
        $customer_details->phone = $contact_number;
        $customer_details->username = $user_name;
        $customer_details->email = $email;
        $customer_details->save();

        $res['success'] = true;
        $res['message'] = 'Customer Details Updated successfully!';

        return response($res);
    }

    public function deleteCustomerDetails($user_id)
    {
        $customer_details = User::find($user_id);
        $customer_details->delete();

        return redirect('admin/user_management/customer/details');
    }

    public function showCallCenterDetails()
    {
        $user = User::role(RoleType::CALL_CENTER)->get();

        return view('account.admin.user_management.call-center.details', ['users' => $user]);
    }

    public function updateCallCenterStatus(Request $request, $user_id)
    {
        $call_center = User::find($user_id);
        $call_center->is_blocked = $request->boolean('switchStatus');
        $call_center->save();

        $res['success'] = true;
        $res['message'] = 'Call Center Status Updated successfully!';

        return response($res);
    }

    public function showEditCallCenterDetails($user_id)
    {
        $call_center_detail = User::find($user_id);

        return view('account.admin.user_management.call-center.edit', ['call_center_details' => $call_center_detail]);
    }

    public function updateCallCenterDetails(Request $request, $user_id)
    {
        $call_center_details = User::find($user_id);

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $contact_number = $request->input('phone');
        $user_name = $request->input('user_name');
        $email = $request->input('email');

        $call_center_details->first_name = $first_name;
        $call_center_details->last_name = $last_name;
        $call_center_details->phone = $contact_number;
        $call_center_details->username = $user_name;
        $call_center_details->email = $email;
        $call_center_details->save();

        $res['success'] = true;
        $res['message'] = 'Call Center Details Updated successfully!';

        return response($res);
    }

    public function deleteCallCenterDetails($user_id)
    {
        $call_center_details = User::find($user_id);
        $call_center_details->delete();

        return redirect('admin/user_management/call_center/details');
    }

    public function showReferralUserDetails()
    {
        $user = User::role(RoleType::REFERRAL_USER)->get();

        return view('account.admin.user_management.referral-user.details', ['users' => $user]);
    }

    public function updateReferralUserStatus(Request $request, $user_id)
    {
        $referral_user = User::find($user_id);
        $referral_user->is_blocked = $request->boolean('switchStatus');
        $referral_user->save();

        $res['success'] = true;
        $res['message'] = 'Refferal User Status Updated successfully!';

        return response($res);
    }

    public function showEditReferralUserDetails($user_id)
    {
        $referral_user_detail = User::find($user_id);

        return view('account.admin.user_management.referral-user.edit', ['referral_user_details' => $referral_user_detail]);
    }

    public function updateReferralUserDetails(Request $request, $user_id)
    {
        $referral_user_details = User::find($user_id);

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $contact_number = $request->input('phone');
        $user_name = $request->input('user_name');
        $email = $request->input('email');

        $referral_user_details->first_name = $first_name;
        $referral_user_details->last_name = $last_name;
        $referral_user_details->phone = $contact_number;
        $referral_user_details->username = $user_name;
        $referral_user_details->email = $email;
        $referral_user_details->save();

        $res['success'] = true;
        $res['message'] = 'Referral User Details Updated successfully!';

        return response($res);
    }

    public function deleteReferralUserDetails($user_id)
    {
        $referral_user_details = User::find($user_id);
        $referral_user_details->delete();

        return redirect('admin/user_management/referral_user/details');
    }

    public function loginAsUser($id)
    {
        $user = User::find($id);

        // dd($user);

        auth()->login($user);

        $role = $user->getRoleNames()->first();
        if ($user->active == 1) {
            switch ($role) {
                case 'property-owner':
                    return redirect('/property-owner/dashboard');
                    break;
                case 'customer':
                    // return redirect('/account/hospital/dashboard');
                    break;
                case 'call-center':
                    return redirect('/call-center/dashboard');
                    break;
                case 'referral-user':
                    // return redirect('/account/vendor/dashboard');
                    break;
                default:
                    return redirect('/');
                    break;
            }
        }
    }
}
