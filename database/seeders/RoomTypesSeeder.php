<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roomType = [

            [
                'type' => 'Single Room',
                'description' => ' A room assigned to one person. May have one or more beds.',
            ],

            [
                'type' => 'Double Room',
                'description' => 'A room assigned to two people. May have one or more beds.',
            ],

            [
                'type' => 'Triple Room',
                'description' => 'A room assigned to three people. May have two or more beds.',
            ],

            [
                'type' => 'Quad Room',
                'description' => 'A room assigned to four people. May have two or more beds.',
            ],

            [
                'type' => 'Queen Room',
                'description' => 'A room with a queen-sized bed. May be occupied by one or more people.',
            ],

            [
                'type' => 'King Room',
                'description' => ' A room with a king-sized bed. May be occupied by one or more people.',
            ],
        ];
        RoomType::insert($roomType);
    }
}
