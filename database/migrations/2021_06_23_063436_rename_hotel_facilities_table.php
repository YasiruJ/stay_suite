<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('hotel_facilities', 'property_facilities');
    }

    public function down()
    {
        //
    }
};
