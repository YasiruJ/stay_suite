<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hotel_reviews', function (Blueprint $table) {
            $table->integer('overall_score')->nullable()->after('property_id');

            $table->string('description')->nullable()->after('property_id');

            $table->string('title')->nullable()->after('property_id');

            $table->integer('review_guest_type_id')->unsigned()->index()->after('property_id');
            $table->foreign('review_guest_type_id')->references('id')->on('review_guest_types')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('booking_id')->unsigned()->index()->after('property_id');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('user_id')->unsigned()->index()->after('property_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('hotel_reviews', function (Blueprint $table) {
            //
        });
    }
};
