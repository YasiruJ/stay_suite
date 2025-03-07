<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyHasAccommodation extends Model
{
    use HasFactory;

    protected $table = 'property_has_accommodations';

    protected $primarykey = 'id';

    protected $fillable = ['property_id', 'accommodation_id'];
}
