<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('availability_room_rate', function (Blueprint $table) {
            $table->integer('sub_room_id')->unsigned()->index();
            $table->foreign('sub_room_id')->references('id')->on('sub_rooms')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('sleep_type_id')->unsigned()->index();
            $table->foreign('sleep_type_id')->references('id')->on('sleep_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        //
    }
};
