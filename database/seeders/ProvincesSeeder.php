<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            ['name' => 'Western Province'],
            ['name' => 'Southern Province'],
            ['name' => 'Central Province'],
            ['name' => 'Uva Province'],
            ['name' => 'Sabaragamuwa Province'],
            ['name' => 'North Central Province'],
            ['name' => 'North Western Province'],
            ['name' => 'Northern Province'],
            ['name' => 'Eastern Province'],
        ];

        foreach ($provinces as $province) {
            Province::updateOrCreate(
                ['name' => $province['name']],
                []
            );
        }
    }
}
