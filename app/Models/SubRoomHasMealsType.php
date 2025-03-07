<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRoomHasMealsType extends Model
{
    use HasFactory;

    protected $table = 'sub_room_has_meals_type';

    protected $primarykey = 'id';

    protected $fillable = ['sub_room_id', 'meal_type_id'];
}
