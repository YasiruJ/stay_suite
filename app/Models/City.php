<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $primarykey = 'id';

    protected $fillable = ['district_id', 'name'];

    protected $with = ['district'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'city_id');
    }
}
