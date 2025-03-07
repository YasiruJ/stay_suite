<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealsType extends Model
{
    use HasFactory;

    protected $table = 'meals_types';

    protected $primarykey = 'id';

    protected $fillable = ['type', 'description'];

    public function subRooms()
    {
        return $this->belongsToMany(SubRooms::class, 'sub_room_has_meals_type', 'sub_room_id', 'meal_type_id');
    }
}
