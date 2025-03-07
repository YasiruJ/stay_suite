<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(CreateSuperAdminUserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PropertyOwnerSeeder::class);
        $this->call(ReferralUserSeeder::class);
        $this->call(CallCenterSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(ProvincesSeeder::class);
        $this->call(DistrictsSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(PropertyFacilitiesSeeder::class);
        $this->call(RoomTypesSeeder::class);
        $this->call(RoomKeyFacilitiesSeeder::class);
        $this->call(RoomFacilitiesSeeder::class);
        $this->call(RoomSubFacilitiesSeeder::class);
        $this->call(BedTypeSeeder::class);
        $this->call(PropertyTypeSeeder::class);
        $this->call(ReviewCategorySeeder::class);
        $this->call(ReviewGuestTypeSeeder::class);
        $this->call(MealTypeSeeder::class);
        $this->call(ResevaionPolicySeeder::class);
        $this->call(ReviewScoreSeeder::class);
        $this->call(BookingStatusSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
