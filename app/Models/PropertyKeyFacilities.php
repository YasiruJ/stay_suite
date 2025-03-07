<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyKeyFacilities extends Model
{
    use HasFactory;

    protected $table = 'property_key_facilities';

    protected $primarykey = 'id';

    protected $fillable = ['name', 'icon'];
}
