<?php

namespace Database\Seeders;

use App\Models\RoomSubFacilities;
use Illuminate\Database\Seeder;

class RoomSubFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subFacilities = [
            [
                'name' => 'Free toiletries',
                'facility_id' => 4,
            ],
            [
                'name' => 'Towels',
                'facility_id' => 4,
            ],
            [
                'name' => 'Slippers',
                'facility_id' => 4,

            ],
            [
                'name' => 'Hairdryer',
                'facility_id' => 3,

            ],
            [
                'name' => 'Lake view',
                'facility_id' => 3,

            ],
            [
                'name' => 'City view',
                'facility_id' => 3,

            ],
            [
                'name' => 'Upper floors accessible by elevator',
                'facility_id' => 3,

            ],
            [
                'name' => 'TV',
                'facility_id' => 3,

            ],
            [
                'name' => 'Telephone',
                'facility_id' => 3,

            ],
            [
                'name' => 'Flat-screen TV',
                'facility_id' => 3,

            ],
            [
                'name' => 'Fold-up bed',
                'facility_id' => 3,

            ],
            [
                'name' => 'Wake-up service',
                'facility_id' => 1,

            ],
            [
                'name' => 'Iron',
                'facility_id' => 1,

            ],
            [
                'name' => 'Soundproofing',
                'facility_id' => 1,

            ],
            [
                'name' => 'Desk',
                'facility_id' => 1,

            ],
            [
                'name' => 'Carpeted',
                'facility_id' => 2,

            ],
            [
                'name' => 'Electric kettle',
                'facility_id' => 2,

            ],
            [
                'name' => 'Satellite channels',
                'facility_id' => 2,

            ],
            [
                'name' => 'Bidet',
                'facility_id' => 2,

            ],
        ];
        RoomSubFacilities::insert($subFacilities);
    }
}
