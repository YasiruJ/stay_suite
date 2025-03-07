<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCategory extends Model
{
    use HasFactory;

    protected $table = 'review_categories';

    protected $primarykey = 'id';

    protected $fillable = ['name'];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_has_reviewcategories', 'property_id', 'review_category_id');
    }

    public function propertyReviews()
    {
        return $this->belongsToMany(PropertyReview::class, 'review_has_review_categories', 'review_category_id', 'review_id');
    }
}
