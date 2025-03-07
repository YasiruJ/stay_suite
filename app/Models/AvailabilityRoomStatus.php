<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRoomStatus extends Model
{
    use HasFactory;

    protected $table = 'availability_room_status';
    protected $fillable = ['date', 'is_room_available', 'room_id'];

    protected $primarykey = 'id';
}
