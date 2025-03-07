<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyHasCreditCard extends Model
{
    use HasFactory;

    protected $table = 'property_has_credit_cards';

    protected $primarykey = 'id';

    protected $fillable = ['property_id', 'credit_card_id'];
}
