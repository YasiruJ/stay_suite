<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dateTime('check_in_date');
            $table->dateTime('check_out_date');
            $table->string('user_id');
            $table->enum('user_type', ['user', 'guest']);
            $table->text('special_request')->nullable();
            $table->string('arrival_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
