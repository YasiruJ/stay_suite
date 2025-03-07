<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            ['province_id' => 1, 'name' => 'Colombo'],
            ['province_id' => 1, 'name' => 'Gampaha'],
            ['province_id' => 1, 'name' => 'Kalutara'],
            ['province_id' => 2, 'name' => 'Galle'],
            ['province_id' => 2, 'name' => 'Matara'],
            ['province_id' => 2, 'name' => 'Hambantota'],
            ['province_id' => 3, 'name' => 'Kandy'],
            ['province_id' => 3, 'name' => 'Matale'],
            ['province_id' => 3, 'name' => 'Nuwara Eliya'],
            ['province_id' => 4, 'name' => 'Badulla'],
            ['province_id' => 4, 'name' => 'Monaragala'],
            ['province_id' => 5, 'name' => 'Ratnapura'],
            ['province_id' => 5, 'name' => 'Kegalle'],
            ['province_id' => 6, 'name' => 'Anuradhapura'],
            ['province_id' => 6, 'name' => 'Polonnaruwa'],
            ['province_id' => 7, 'name' => 'Kurunegala'],
            ['province_id' => 7, 'name' => 'Puttalam'],
            ['province_id' => 8, 'name' => 'Jaffna'],
            ['province_id' => 8, 'name' => 'Kilinochchi'],
            ['province_id' => 8, 'name' => 'Mannar'],
            ['province_id' => 8, 'name' => 'Vavuniya'],
            ['province_id' => 8, 'name' => 'Mullaitivu'],
            ['province_id' => 9, 'name' => 'Trincomalee'],
            ['province_id' => 9, 'name' => 'Batticaloa'],
            ['province_id' => 9, 'name' => 'Ampara'],
        ];

        foreach ($districts as $district) {
            District::updateOrCreate(
                ['name' => $district['name']],
                ['province_id' => $district['province_id']]
            );
        }
    }
}
