<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('occupancy');
            $table->dropColumn('rate');
            $table->dropColumn('no_of_rooms');
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            //
        });
    }
};
