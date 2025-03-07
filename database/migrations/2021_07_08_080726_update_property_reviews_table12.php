<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('property_reviews', function (Blueprint $table) {
            $table->float('overall_score')->nullable()->after('property_id')->change();
        });
    }

    public function down()
    {
        Schema::table('property_reviews', function (Blueprint $table) {
            //
        });
    }
};
