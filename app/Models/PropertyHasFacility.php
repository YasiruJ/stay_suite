<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyHasFacility extends Model
{
    use HasFactory;

    protected $table = 'property_has_facilities';

    protected $primarykey = 'id';

    protected $fillable = [
        'property_id', 'property_facility_id',
    ];
}
