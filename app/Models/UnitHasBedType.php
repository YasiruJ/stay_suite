<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitHasBedType extends Model
{
    use HasFactory;

    protected $table = 'unit_has_bed_type';

    protected $primarykey = 'id';

    protected $fillable = ['unit_id', 'bed_type_id', 'bed_count'];
}
