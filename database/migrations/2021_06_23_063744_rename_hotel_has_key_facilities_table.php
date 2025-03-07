<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('hotel_has_key_facilities', 'property_has_key_facilities');
    }

    public function down()
    {
        //
    }
};
