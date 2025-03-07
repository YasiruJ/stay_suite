<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('review_has_review_categories', function (Blueprint $table) {
            $table->integer('rating')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('review_has_review_categories', function (Blueprint $table) {
            //
        });
    }
};
