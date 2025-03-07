<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->boolean('pet_allowed')->nullable()->after('minimum_rate');
            $table->integer('age_restriction')->nullable()->after('minimum_rate');
            $table->time('check_out_end_time')->nullable()->after('minimum_rate');
            $table->time('check_out_start_time')->nullable()->after('minimum_rate');
            $table->time('check_in_end_time')->nullable()->after('minimum_rate');
            $table->time('check_in_start_time')->nullable()->after('minimum_rate');
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
};
