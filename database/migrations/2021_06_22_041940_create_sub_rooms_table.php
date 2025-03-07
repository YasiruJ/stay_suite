<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_rooms', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('room_id')->unsigned()->index();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('meals_type_id')->unsigned()->index();
            $table->foreign('meals_type_id')->references('id')->on('meals_types')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('reservation_policy_id')->unsigned()->index();
            $table->foreign('reservation_policy_id')->references('id')->on('reservation_policies')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('sleep_type_id')->unsigned()->index();
            $table->foreign('sleep_type_id')->references('id')->on('sleep_types')->onDelete('cascade')->onUpdate('cascade');

            $table->decimal('rate', 7, 2);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_rooms');
    }
};
