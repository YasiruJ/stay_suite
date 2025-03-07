<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('facilities', 'room_facilities');
    }

    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
            //
        });
    }
};
