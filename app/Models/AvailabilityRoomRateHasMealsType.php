<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRoomRateHasMealsType extends Model
{
    use HasFactory;

    protected $table = 'availability_room_rate_has_meals_type';

    protected $primarykey = 'id';
}
