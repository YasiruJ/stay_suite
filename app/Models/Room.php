<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $primarykey = 'id';

    protected $fillable = ['property_id', 'type_id', 'title', 'description', 'room_size', 'occupancy', 'no_of_rooms', 'main_image', 'rate'];

    protected $with = ['roomType', 'units'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'type_id');
    }

    public function roomFacilities()
    {
        return $this->belongsToMany(RoomFacility::class, 'room_has_facilities', 'room_id', 'facility_id');
    }

    public function roomSubFacilities()
    {
        return $this->belongsToMany(RoomSubFacilities::class, 'room_has_sub_facilities', 'room_id', 'sub_facility_id');
    }

    public function roomImages()
    {
        return $this->hasMany(RoomImage::class, 'room_id');
    }

    public function subRooms()
    {
        return $this->hasMany(SubRooms::class, 'room_id');
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'room_has_unit', 'room_id', 'unit_id');
    }
}
