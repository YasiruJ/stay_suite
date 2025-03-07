<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRoomRate extends Model
{
    use HasFactory;

    protected $table = 'availability_room_rate';
    protected $fillable = ['date', 'room_rate', 'room_id', 'sub_room_id', 'sleep_count'];
    protected $primarykey = 'id';

    public function mealTypes()
    {
        return $this->belongsToMany(MealsType::class, 'availability_room_rate_has_meals_type', 'availability_room_rate_id', 'meal_type_id');
    }

    public function reservationPolicies()
    {
        return $this->belongsToMany(ReservationPolicy::class, 'availability_room_rate_has_reservation_policy', 'availability_room_rate_id', 'reservation_policy_id');
    }
}
