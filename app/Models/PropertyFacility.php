<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFacility extends Model
{
    use HasFactory;

    protected $table = 'property_facilities';

    protected $primarykey = 'id';

    protected $fillable = ['name', 'description'];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_has_facilities', 'property_facility_id', 'property_id');
    }
}
