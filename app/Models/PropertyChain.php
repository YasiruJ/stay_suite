<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyChain extends Model
{
    use HasFactory;

    protected $table = 'property_chains';

    protected $primarykey = 'id';

    protected $fillable = ['name', 'owner_id', 'description'];
}
