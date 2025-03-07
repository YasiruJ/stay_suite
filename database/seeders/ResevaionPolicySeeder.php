<?php

namespace Database\Seeders;

use App\Models\ReservationPolicy;
use Illuminate\Database\Seeder;

class ResevaionPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservation_policy = [
            [
                'type' => 'Free cancelation',
            ],

            [
                'type' => 'Book without creadit card',
            ],

            [
                'type' => 'No prepayments',

            ],

        ];
        ReservationPolicy::insert($reservation_policy);
    }
}
