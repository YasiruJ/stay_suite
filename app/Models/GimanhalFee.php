<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GimanhalFee extends Model
{
    use HasFactory;

    protected $table = 'gimanhal_fees';

    protected $primarykey = 'id';

    protected $fillable = ['fee', 'method'];
}
