<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('hotel_reviews', 'property_reviews');
    }

    public function down()
    {
        //
    }
};
