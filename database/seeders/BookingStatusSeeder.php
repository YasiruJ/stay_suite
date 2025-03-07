<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = [
            [
                'id' => 1,
                'type' => 'pending',
            ],

            [
                'id' => 2,
                'type' => 'confirmed',
            ],

            [
                'id' => 3,
                'type' => 'payment-rejected',
            ],

            [
                'id' => 4,
                'type' => 'rejected',
            ],

            [
                'id' => 5,
                'type' => 'booking-done',
            ],

            [
                'id' => 6,
                'type' => 'payment-settled',
            ],

            [
                'id' => 7,
                'type' => 'absent',
            ],
        ];

        BookingStatus::insert($city);
    }
}
