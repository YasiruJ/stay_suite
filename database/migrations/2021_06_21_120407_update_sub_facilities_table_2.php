<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('sub_facilities', 'room_sub_facilities');
    }

    public function down()
    {
        Schema::table('sub_facilities', function (Blueprint $table) {
            //
        });
    }
};
