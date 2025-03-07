<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CallCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(2)->create()->each(function ($user) {
        //     $role = Role::findByName(RoleType::CALL_CENTER());
        //     $user->assignRole($role);
        // });
    }
}
