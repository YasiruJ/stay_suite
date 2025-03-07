<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewGuestType extends Model
{
    use HasFactory;

    protected $table = 'review_guest_types';

    protected $primarykey = 'id';

    protected $fillable = ['name'];

    public function propertyReviews()
    {
        return $this->hasMany(PropertyReview::class, 'review_guest_type_id');
    }
}
