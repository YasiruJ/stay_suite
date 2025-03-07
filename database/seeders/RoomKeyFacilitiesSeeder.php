<?php

namespace Database\Seeders;

use App\Models\RoomKeyFacilities;
use Illuminate\Database\Seeder;

class RoomKeyFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keyFacilities = [
            [
                'name' => 'Balcony',
            ],

            [
                'name' => 'Pool with a view',
            ],

            [
                'name' => 'Rooftop pool',

            ],

            [
                'name' => 'Air conditioning',

            ],
            [
                'name' => 'Private bathroom',
            ],

            [
                'name' => 'Flat-screen Tv',
            ],

            [
                'name' => 'Soundproofing',

            ],

            [
                'name' => 'Minibar',

            ],
            [
                'name' => 'Free WiFi',

            ],
        ];
        RoomKeyFacilities::insert($keyFacilities);
    }
}
