<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyHasReviewCategory extends Model
{
    use HasFactory;

    protected $table = 'property_has_review_categories';

    protected $primarykey = 'id';

    protected $fillable = [
        'property_id', 'review_category_id',
    ];
}
