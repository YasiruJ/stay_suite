<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_type = [
            [
                'type' => 'Hotels',
            ],

            [
                'type' => 'Villas',
            ],

            [
                'type' => 'Guest house',

            ],

            [
                'type' => 'Lodges',

            ],
            [
                'type' => 'Campsites',
            ],

            [
                'type' => 'Chrlets',
            ],
            [
                'type' => 'Resorts',
            ],

        ];
        PropertyType::insert($property_type);
    }
}
