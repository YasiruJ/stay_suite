<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_id')->after('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('city');
            $table->string('zip_code');
            $table->string('phone');
            $table->string('email');
            $table->double('property_owner_fee')->nullable();
            $table->double('gimanhal_fee')->nullable();
            $table->double('total')->nullable();
            $table->enum('payment_type', ['online', 'pay_at_location']);
            $table->integer('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on('booking_statuses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
