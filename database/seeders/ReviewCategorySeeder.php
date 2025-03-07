<?php

namespace Database\Seeders;

use App\Models\ReviewCategory;
use Illuminate\Database\Seeder;

class ReviewCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviewCategory = [
            [
                'name' => 'Cleanliness',
            ],

            [
                'name' => 'Staff',
            ],

            [
                'name' => 'Comfort',
            ],

            [
                'name' => 'Location',
            ],

            [
                'name' => 'Facilities',
            ],

            [
                'name' => 'Value for money',
            ],

            [
                'name' => 'Free WiFi',
            ],
        ];
        ReviewCategory::insert($reviewCategory);
    }
}
