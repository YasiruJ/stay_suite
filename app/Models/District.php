<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $primarykey = 'id';

    protected $fillable = ['province_id', 'name'];

    protected $with = ['province'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'district_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'district_id');
    }
}
