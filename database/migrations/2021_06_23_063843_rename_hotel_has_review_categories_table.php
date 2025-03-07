<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('hotel_has_review_categories', 'property_has_review_categories');
    }

    public function down()
    {
        //
    }
};
