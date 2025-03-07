<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewHasReviewCategory extends Model
{
    use HasFactory;

    protected $table = 'review_has_review_categories';

    protected $primarykey = 'id';

    protected $fillable = ['review_category_id', 'review_id'];

    public function propertyReviews()
    {
        return $this->belongsTo(PropertyReview::class, 'review_id');
    }

    public function reviewCategories()
    {
        return $this->belongsTo(ReviewCategory::class, 'review_category_id');
    }
}
