<?php

namespace Database\Seeders;

use App\Models\PropertyFacility;
use Illuminate\Database\Seeder;

class PropertyFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertyFacility = [
            [
                'name' => 'Safety & security',
                'description' => 'CCTV outside property, 24-hour security',

            ],

            [
                'name' => 'Outdoors',
                'description' => 'Balcony, Garden',

            ],

            [
                'name' => 'Kitchen',
                'description' => 'Shared kitchen, Electric kettle',

            ],

            [
                'name' => 'General',
                'description' => 'Air conditioning, Designated smoking area',

            ],

            [
                'name' => 'Wellness facilities',
                'description' => 'Full body massage, Head massage',

            ],

            [
                'name' => 'Parking',
                'description' => 'Street parking, Secured parking',
            ],
        ];
        PropertyFacility::insert($propertyFacility);
    }
}
