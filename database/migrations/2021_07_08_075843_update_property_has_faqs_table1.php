<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('property_has_faqs', function (Blueprint $table) {
            $table->longText('answer')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('property_has_faqs', function (Blueprint $table) {
            //
        });
    }
};
