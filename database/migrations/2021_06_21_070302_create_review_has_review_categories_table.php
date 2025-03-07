<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review_has_review_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('review_id')->unsigned()->index();
            $table->foreign('review_id')->references('id')->on('hotel_reviews')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('review_category_id')->unsigned()->index();
            $table->foreign('review_category_id')->references('id')->on('review_categories')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('rating');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_has_review_categories');
    }
};
