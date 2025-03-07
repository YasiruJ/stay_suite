<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->integer('property_clicks')->default(0)->after('active');
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            //
        });
    }
};
