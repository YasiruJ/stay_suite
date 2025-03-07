<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    use HasFactory;

    protected $table = 'bed_types';

    protected $primarykey = 'id';

    protected $fillable = ['type', 'capacity', 'icon'];

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_has_bed_type', 'unit_id', 'bed_type_id');
    }
}
