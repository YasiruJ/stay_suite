<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHasSubroom extends Model
{
    use HasFactory;
    protected $table = 'booking_has_subrooms';

    protected $primarykey = 'id';

    protected $fillable = ['booking_id','room_id', 'subroom_id'];


    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }


    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function subRoom()
    {
        return $this->belongsTo(SubRooms::class, 'subroom_id');
    }
}
