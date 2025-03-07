<?php

namespace App\Traits;

use App\Models\Property;
use App\Models\PropertyReview;

trait CalculateAvgReviewScore
{
    public function calculatePropertyReviewScore($property_id)
    {
        $property = Property::find($property_id);

        $property_avg_review_score = (float) round(PropertyReview::where('property_id', $property_id)->avg('overall_score', 1), 1);
        $property->average_review_score = $property_avg_review_score;

        if ($property_avg_review_score >= 6.0) {
            if ($property_avg_review_score >= 7.0) {
                if ($property_avg_review_score >= 8.0) {
                    if ($property_avg_review_score >= 9.0) {
                        $property->review_score_id = 1;
                    } else {
                        $property->review_score_id = 2;
                    }
                } else {
                    $property->review_score_id = 3;
                }
            } else {
                $property->review_score_id = 4;
            }
        } else {
            $property->review_score_id = 5;
        }
        $property->save();
    }
}
