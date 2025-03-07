<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hotel_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('property_id')->unsigned()->index();
            $table->foreign('property_id')->references('id')->on('hotels')->onDelete('cascade')->onUpdate('cascade');

            $table->string('name')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_images');
    }
};
