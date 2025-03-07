<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['main_image']);
            $table->boolean('active')->nullable()->default(1)->after('room_size');
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            //
        });
    }
};
