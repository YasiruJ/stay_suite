<?php

namespace App\Traits;

use App\Models\Property;
use App\Models\Room;
use App\Models\SubRooms;

trait CalculateMiniumRate
{
    public function calculateMiniumRateAll()
    {
    }

    public function calculateMiniumRateOne($property_id, $room_id, $sub_room_rate)
    {
        $room = Room::find($room_id);
        $property = Property::find($property_id);
        $sub_room = SubRooms::where('room_id', $room_id)->orderByRaw('ISNULL(rate), rate ASC')->first();
        $minimum_room_rate = $sub_room->rate;
        if ($minimum_room_rate == $sub_room_rate) {
            $room->minimum_rate = $minimum_room_rate;
            $room->save();

            $property->minimum_rate = $minimum_room_rate;
            $property->save();
        } elseif ($sub_room_rate != null) {
            $room->minimum_rate = $minimum_room_rate;
            $room->save();

            $property->minimum_rate = $minimum_room_rate;
            $property->save();
        }
    }
}
