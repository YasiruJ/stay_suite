<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomKeyFacilities extends Model
{
    use HasFactory;

    protected $table = 'room_key_facilities';

    protected $primarykey = 'id';

    protected $fillable = ['name'];
}
