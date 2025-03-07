<?php

namespace Database\Seeders;

use App\Models\ReviewGuestType;
use Illuminate\Database\Seeder;

class ReviewGuestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviewGuestType = [
            [
                'name' => 'families',
            ],

            [
                'name' => 'couples',
            ],

            [
                'name' => 'group of friends',
            ],

            [
                'name' => 'travels',
            ],

            [
                'name' => 'business travelers',
            ],
        ];
        ReviewGuestType::insert($reviewGuestType);
    }
}
