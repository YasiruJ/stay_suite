<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomHasUnit extends Model
{
    use HasFactory;

    protected $table = 'room_has_unit';

    protected $primarykey = 'id';

    protected $fillable = ['room_id', 'unit_id'];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function room_unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
