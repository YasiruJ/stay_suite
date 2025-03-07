<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => '1',
                'name' => 'super-admin',
                'guard_name' => 'web',
            ],
            [
                'id' => '2',
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'id' => '3',
                'name' => 'property-owner',
                'guard_name' => 'web',
            ],
            [
                'id' => '4',
                'name' => 'customer',
                'guard_name' => 'web',
            ],
            [
                'id' => '5',
                'name' => 'call-center',
                'guard_name' => 'web',
            ],
            [
                'id' => '6',
                'name' => 'referral-user',
                'guard_name' => 'web',
            ],
        ];

        Role::insert($roles);
    }
}
