<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PropertyReview extends Model
{
    use HasFactory;

    protected $table = 'property_reviews';

    protected $primarykey = 'id';

    protected $fillable = ['property_id', 'user_id', 'booking_id', 'review_guest_type_id', 'title', 'description', 'overall_score', 'property_response'];

    public function properties()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function reviewGuestTypes()
    {
        return $this->belongsTo(ReviewGuestType::class, 'review_guest_type_id');
    }

    public function reviewCategories()
    {
        return $this->belongsToMany(ReviewCategory::class, 'review_has_review_categories', 'review_id', 'review_category_id');
    }

    public function findReview($id)
    {
        return DB::table('review_has_review_categories')
            ->join('property_reviews', 'review_has_review_categories.review_id', '=', 'property_reviews.id')
            ->join('review_categories', 'review_has_review_categories.review_category_id', '=', 'review_categories.id')
            ->select(
                'review_categories.name', 'review_has_review_categories.rating'
            )
            ->where('review_has_review_categories.review_id', '=', $id)
            ->get();
    }
}
