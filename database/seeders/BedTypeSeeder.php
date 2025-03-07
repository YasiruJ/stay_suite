<?php

namespace Database\Seeders;

use App\Models\BedType;
use Illuminate\Database\Seeder;

class BedTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bed_types = [
            [
                'type' => 'single bed',
                'capacity' => 1,
                'icon' => 'bed',
            ],
            [
                'type' => 'double bed',
                'capacity' => 2,
                'icon' => 'bed',
            ],
            [
                'type' => 'large double bed ',
                'capacity' => 2,
                'icon' => 'bed',
            ],
            [
                'type' => 'extra-large double bed',
                'capacity' => 3,
                'icon' => 'bed',
            ],

            [
                'type' => 'bunk beds',
                'capacity' => 2,
                'icon' => 'bed-bunk',
            ],
            [
                'type' => 'sofa beds',
                'capacity' => 1,
                'icon' => 'bed',
            ],
        ];
        BedType::insert($bed_types);
    }
}
