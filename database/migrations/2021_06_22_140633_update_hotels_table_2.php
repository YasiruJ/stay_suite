<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->integer('property_type_id')->unsigned()->index()->after('user_id');
            $table->foreign('property_type_id')->references('id')->on('property_type')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            //
        });
    }
};
