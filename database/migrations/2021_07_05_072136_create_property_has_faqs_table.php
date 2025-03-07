<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('property_has_faqs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('property_id')->unsigned()->index();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade')->onUpdate('cascade');

            $table->string('question')->nullable();

            $table->string('answer')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_has_faqs');
    }
};
