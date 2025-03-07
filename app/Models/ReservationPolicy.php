<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPolicy extends Model
{
    use HasFactory;

    protected $table = 'reservation_policies';

    protected $primarykey = 'id';

    protected $fillable = ['name', 'type', 'description'];

    public function subRooms()
    {
        return $this->belongsToMany(SubRooms::class, 'sub_room_has_reservation_policy', 'sub_room_id', 'reservation_policy_id');
    }
}
