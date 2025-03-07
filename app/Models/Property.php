<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $primarykey = 'id';

    protected $fillable = [
        'user_id', 'property_type_id', 'city_id', 'district_id', 'name', 'address', 'description', 'longitude',
        'latitude', 'place_id', 'admin_active', 'property_active', 'property_clicks', 'main_image', 'average_review_score',
        'review_score_id', 'star_rating', 'minimum_rate',
    ];

    protected $with = ['propertyType', 'city', 'reviewScore'];

    protected $casts = [
        'admin_active' => 'boolean',
        'property_active' => 'boolean',
        'pet_allowed' => 'boolean',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'property_id');
        // return $this->hasMany(Room::class, 'property_id')->orderByRaw('ISNULL(minimum_rate), minimum_rate ASC');
    }

    public function getRoomIds($property_id)
    {
        return Room::where('property_id', $property_id)->pluck('id');
    }

    public function districts()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function facilities()
    {
        return $this->belongsToMany(PropertyFacility::class, 'property_has_facilities', 'property_id', 'property_facility_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewCategories()
    {
        return $this->belongsToMany(ReviewCategory::class, 'property_has_review_categories', 'property_id', 'review_category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'property_id');
    }

    public function propertyReviews()
    {
        return $this->hasMany(PropertyReview::class, 'property_id');
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function faqs()
    {
        return $this->hasMany(PropertyHasFaq::class, 'property_id');
    }

    public function creditCards()
    {
        return $this->belongsToMany(CreditCard::class, 'property_has_credit_cards', 'property_id', 'credit_card_id');
    }

    public function reviewScore()
    {
        return $this->belongsTo(ReviewScore::class, 'review_score_id');
    }
}
