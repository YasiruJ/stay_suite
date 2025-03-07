<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use HasFactory;

    protected $table = 'room_facilities';

    protected $primarykey = 'id';

    protected $fillable = ['name', 'description'];

    public function facility()
    {
        return $this->hasMany(RoomHasSubFcilities::class, 'facility_id');
    }

    public function subFacilities()
    {
        return $this->hasMany(RoomSubFacility::class, 'facility_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_has_facilities', 'facility_id', 'room_id');
    }
}
