<?php

namespace Database\Seeders;

use App\Models\ReviewScore;
use Illuminate\Database\Seeder;

class ReviewScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviewScore = [
            [
                'name' => 'Superb: 9+',
            ],

            [
                'name' => 'Very good: 8+',
            ],

            [
                'name' => 'Good: 7+',
            ],

            [
                'name' => 'Pleasant: 6+',
            ],

            [
                'name' => 'Adequate: 6-',
            ],

        ];
        ReviewScore::insert($reviewScore);
    }
}
