<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomSubFacilities extends Model
{
    use HasFactory;

    protected $table = 'room_sub_facilities';

    protected $primarykey = 'id';

    protected $fillable = ['name', 'facility_id'];

    public function facilities()
    {
        return $this->belongsTo(RoomFacility::class, 'facility_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_has_sub_facilities', 'sub_facility_id', 'room_id');
    }
}
