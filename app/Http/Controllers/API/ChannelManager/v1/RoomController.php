<?php

namespace App\Http\Controllers\API\ChannelManager\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\ApiResourceCollection;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function getAllRooms(Request $request, $property_id)
    {
        $property = Property::where('id', '=', $property_id)
            ->where('admin_active', true)
            ->where('property_active', true)
            ->first();

        if (! $property) {
            return response(['errors' => 'Property not found.'], 205);
        }

        $rooms = Room::where('property_id', $property->id)
            ->where('active', true)
            ->get();

        return new ApiResourceCollection($rooms);
    }
}
