<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewScore extends Model
{
    use HasFactory;

    protected $table = 'review_scores';

    protected $primarykey = 'id';

    protected $fillable = ['name'];

    public function properties()
    {
        return $this->hasMany(Property::class, 'review_score_id');
    }
}
