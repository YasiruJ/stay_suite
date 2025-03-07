<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('availability_room_rate_has_meals_type', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('availability_room_rate_id')->unsigned()->index('ava_room_rate_meals_type_index');
            $table->foreign('availability_room_rate_id', 'ava_room_rate_meals_type_foreign')->references('id')->on('availability_room_rate')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('meal_type_id')->unsigned()->index('meal_type_id_index');
            $table->foreign('meal_type_id', 'meal_type_id_foreign')->references('id')->on('meals_types')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('availability_room_rate_has_meals_types');
    }
};
