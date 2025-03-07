<?php

namespace Database\Seeders;

use App\Models\RoomFacility;
use Illuminate\Database\Seeder;

class RoomFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facilities = [
            [
                'name' => 'In your shared bathroom:',
            ],

            [
                'name' => 'Room facilities',
            ],

            [
                'name' => 'View',
            ],

            [
                'name' => 'In your private bathroom',
            ],
        ];
        RoomFacility::insert($facilities);
    }
}
