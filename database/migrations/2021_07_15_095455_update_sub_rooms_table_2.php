<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sub_rooms', function (Blueprint $table) {
            $table->boolean('active')->nullable()->default(1)->after('rate');
        });
    }

    public function down()
    {
        Schema::table('sub_rooms', function (Blueprint $table) {
            //
        });
    }
};
