<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('property_id')->unsigned()->index();
            $table->foreign('property_id')->references('id')->on('hotels')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('room_types')->onDelete('cascade')->onUpdate('cascade');

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('room_size')->nullable();
            $table->string('occupancy')->nullable();
            $table->integer('no_of_rooms');
            $table->string('main_image')->nullable();
            $table->double('rate');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
