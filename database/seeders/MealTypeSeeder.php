<?php

namespace Database\Seeders;

use App\Models\MealsType;
use Illuminate\Database\Seeder;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals_types = [
            [
                'type' => 'Self catering',
            ],

            [
                'type' => 'Breakfast & lunch included',
            ],

            [
                'type' => 'All meals included',

            ],

            [
                'type' => 'All-inclusive',

            ],
            [
                'type' => 'Breakfast dinner include',
            ],

            [
                'type' => 'Breakfast included',
            ],

        ];
        MealsType::insert($meals_types);
    }
}
