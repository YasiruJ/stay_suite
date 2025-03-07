<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyHasKeyFacilities extends Model
{
    use HasFactory;

    protected $table = 'property_has_key_facilities';

    protected $primarykey = 'id';

    protected $fillable = [
        'property_id', 'property_key_facility_id',
    ];
}
