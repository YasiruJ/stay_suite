<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('hotel_accommodations', 'property_accommodations');
    }

    public function down()
    {
        //
    }
};
