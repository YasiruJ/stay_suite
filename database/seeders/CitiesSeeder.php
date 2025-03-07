<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['district_id' => 1, 'name' => 'Colombo'],
            ['district_id' => 1, 'name' => 'Dehiwala-Mount Lavinia'],
            ['district_id' => 1, 'name' => 'Moratuwa'],
            ['district_id' => 2, 'name' => 'Negombo'],
            ['district_id' => 2, 'name' => 'Gampaha'],
            ['district_id' => 2, 'name' => 'Minuwangoda'],
            ['district_id' => 3, 'name' => 'Kalutara'],
            ['district_id' => 3, 'name' => 'Beruwala'],
            ['district_id' => 3, 'name' => 'Panadura'],
            ['district_id' => 4, 'name' => 'Galle'],
            ['district_id' => 4, 'name' => 'Ambalangoda'],
            ['district_id' => 4, 'name' => 'Hikkaduwa'],
            ['district_id' => 5, 'name' => 'Matara'],
            ['district_id' => 5, 'name' => 'Weligama'],
            ['district_id' => 5, 'name' => 'Akuressa'],
            ['district_id' => 6, 'name' => 'Hambantota'],
            ['district_id' => 6, 'name' => 'Tangalle'],
            ['district_id' => 6, 'name' => 'Beliatta'],
            ['district_id' => 7, 'name' => 'Kandy'],
            ['district_id' => 7, 'name' => 'Peradeniya'],
            ['district_id' => 7, 'name' => 'Gampola'],
            ['district_id' => 8, 'name' => 'Matale'],
            ['district_id' => 8, 'name' => 'Dambulla'],
            ['district_id' => 8, 'name' => 'Sigiriya'],
            ['district_id' => 9, 'name' => 'Nuwara Eliya'],
            ['district_id' => 9, 'name' => 'Hatton'],
            ['district_id' => 9, 'name' => 'Talawakele'],
            ['district_id' => 10, 'name' => 'Badulla'],
            ['district_id' => 10, 'name' => 'Bandarawela'],
            ['district_id' => 10, 'name' => 'Haputale'],
            ['district_id' => 11, 'name' => 'Monaragala'],
            ['district_id' => 11, 'name' => 'Wellawaya'],
            ['district_id' => 11, 'name' => 'Bibile'],
            ['district_id' => 12, 'name' => 'Ratnapura'],
            ['district_id' => 12, 'name' => 'Balangoda'],
            ['district_id' => 12, 'name' => 'Embilipitiya'],
            ['district_id' => 13, 'name' => 'Kegalle'],
            ['district_id' => 13, 'name' => 'Mawanella'],
            ['district_id' => 13, 'name' => 'Warakapola'],
            ['district_id' => 14, 'name' => 'Anuradhapura'],
            ['district_id' => 14, 'name' => 'Mihintale'],
            ['district_id' => 14, 'name' => 'Kekirawa'],
            ['district_id' => 15, 'name' => 'Polonnaruwa'],
            ['district_id' => 15, 'name' => 'Hingurakgoda'],
            ['district_id' => 15, 'name' => 'Medirigiriya'],
            ['district_id' => 16, 'name' => 'Kurunegala'],
            ['district_id' => 16, 'name' => 'Kuliyapitiya'],
            ['district_id' => 16, 'name' => 'Maho'],
            ['district_id' => 17, 'name' => 'Puttalam'],
            ['district_id' => 17, 'name' => 'Chilaw'],
            ['district_id' => 17, 'name' => 'Wennappuwa'],
            ['district_id' => 18, 'name' => 'Jaffna'],
            ['district_id' => 18, 'name' => 'Chavakachcheri'],
            ['district_id' => 18, 'name' => 'Point Pedro'],
            ['district_id' => 19, 'name' => 'Kilinochchi'],
            ['district_id' => 20, 'name' => 'Mannar'],
            ['district_id' => 21, 'name' => 'Vavuniya'],
            ['district_id' => 22, 'name' => 'Mullaitivu'],
            ['district_id' => 23, 'name' => 'Trincomalee'],
            ['district_id' => 23, 'name' => 'Kinniya'],
            ['district_id' => 24, 'name' => 'Batticaloa'],
            ['district_id' => 24, 'name' => 'Kattankudy'],
            ['district_id' => 25, 'name' => 'Ampara'],
            ['district_id' => 25, 'name' => 'Sammanthurai'],
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(
                ['name' => $city['name']],
                ['district_id' => $city['district_id']]
            );
        }
    }
}
