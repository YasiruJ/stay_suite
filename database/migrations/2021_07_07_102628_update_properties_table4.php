<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('review_score_id')->unsigned()->index()->nullable()->after('main_image');
            $table->foreign('review_score_id')->references('id')->on('review_scores')->onDelete('cascade')->onUpdate('cascade');
            $table->float('average_review_score')->nullable()->after('main_image');
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
};
