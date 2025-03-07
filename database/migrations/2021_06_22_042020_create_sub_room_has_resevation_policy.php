<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_room_has_reservation_policy', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sub_room_id')->unsigned()->index();
            $table->foreign('sub_room_id')->references('id')->on('sub_rooms')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('reservation_policy_id')->unsigned()->index();
            $table->foreign('reservation_policy_id')->references('id')->on('reservation_policies')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_room_has_reservation_policy');
    }
};
