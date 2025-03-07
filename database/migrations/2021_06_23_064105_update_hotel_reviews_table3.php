<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hotel_reviews', function (Blueprint $table) {
            $table->string('property_response')->nullable()->after('overall_score');
        });
    }

    public function down()
    {
        Schema::table('hotel_reviews', function (Blueprint $table) {
            //
        });
    }
};
