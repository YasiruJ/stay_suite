<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomHasFacility extends Model
{
    use HasFactory;

    protected $table = 'room_has_facilities';

    protected $primarykey = 'id';

    protected $fillable = ['room_id', 'facility_id'];

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function facilities()
    {
        return $this->belongsTo(RoomFacility::class, 'facility_id');
    }
}
