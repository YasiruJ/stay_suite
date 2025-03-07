<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('hotel_has_accommodations', 'property_has_accommodations');
    }

    public function down()
    {
        //
    }
};
