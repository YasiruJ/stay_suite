<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRoomHasReservationPolicy extends Model
{
    use HasFactory;

    protected $table = 'sub_room_has_reservation_policy';

    protected $primarykey = 'id';

    protected $fillable = ['sub_room_id', 'reservation_policy_id'];

    public function policy()
    {
        return $this->belongsTo(ReservationPolicy::class, 'reservation_policy_id');
    }
}
