<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRooms extends Model
{
    use HasFactory;

    protected $table = 'sub_rooms';

    protected $primarykey = 'id';

    protected $fillable = ['room_id', 'rate', 'active', 'sleep_count'];

    protected $with = ['mealTypes', 'reservationPolicies'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function mealTypes()
    {
        return $this->belongsToMany(MealsType::class, 'sub_room_has_meals_type', 'sub_room_id', 'meal_type_id');
    }

    public function reservationPolicies()
    {
        return $this->belongsToMany(ReservationPolicy::class, 'sub_room_has_reservation_policy', 'sub_room_id', 'reservation_policy_id');
    }
}
