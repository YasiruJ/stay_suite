<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRoomRateHasReservationPolicy extends Model
{
    use HasFactory;

    protected $table = 'availability_room_rate_has_reservation_policy';

    protected $primarykey = 'id';
}
