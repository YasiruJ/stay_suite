<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('availability_room_rate_has_reservation_policy', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('availability_room_rate_id')->unsigned()->index('ava_room_rate_reservation_policy_index');
            $table->foreign('availability_room_rate_id', 'ava_room_rate_reservation_policy_foreign')->references('id')->on('availability_room_rate')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('reservation_policy_id')->unsigned()->index('reservation_policy_id_index');
            $table->foreign('reservation_policy_id', 'reservation_policy_id_foreign')->references('id')->on('reservation_policies')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('availability_room_rate_has_reservation_policies');
    }
};
