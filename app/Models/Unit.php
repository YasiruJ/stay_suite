<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $primarykey = 'id';

    protected $fillable = ['type'];

    protected $with = ['bedTypes'];

    public function rooms()
    {
        return $this->belongsToMany(Rooms::class, 'room_has_unit', 'room_id', 'unit_id');
    }

    public function bedTypes()
    {
        return $this->belongsToMany(BedType::class, 'unit_has_bed_type', 'unit_id', 'bed_type_id')->withPivot('bed_count');
    }
}
