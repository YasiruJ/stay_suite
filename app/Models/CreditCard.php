<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $table = 'credit_cards';

    protected $primarykey = 'id';

    protected $fillable = ['card_type', 'credit_card_image'];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_has_credit_cards', 'credit_card_id', 'property_id');
    }
}
