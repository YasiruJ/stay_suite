<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomHasSubFacilities extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'room_has_sub_facilities';

    protected $primarykey = 'id';

    protected $fillable = ['room_id', 'sub_facility_id'];
}
