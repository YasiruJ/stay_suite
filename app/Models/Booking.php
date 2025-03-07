<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $primarykey = 'id';

    protected $fillable = [
        'booking_id', 'property_id', 'check_in_date', 'check_out_date', 'user_id', 'user_type', 'special_request', 'arrival_time',
        'first_name', 'last_name', 'address', 'city', 'zip_code', 'phone', 'email', 'property_owner_fee',
        'gimanhal_fee', 'total', 'payment_type', 'status_id','transaction_id',
    ];

    protected $with = ['subRooms'];

    public function subRooms()
    {
        return $this->hasMany(BookingHasSubroom::class, 'booking_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function bookingStatus()
    {
        return $this->belongsTo(BookingStatus::class, 'status_id');
    }


}
