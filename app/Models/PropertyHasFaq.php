<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyHasFaq extends Model
{
    use HasFactory;

    protected $table = 'property_has_faqs';

    protected $primarykey = 'id';

    protected $fillable = [
        'property_id', 'question', 'answer',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
