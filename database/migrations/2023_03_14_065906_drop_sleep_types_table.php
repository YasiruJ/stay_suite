<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('availability_room_rate', function (Blueprint $table) {
            $table->dropForeign('availability_room_rate_sleep_type_id_foreign');
            $table->dropColumn('sleep_type_id');
        });

        Schema::table('sub_rooms', function (Blueprint $table) {
            $table->dropForeign('sub_rooms_sleep_type_id_foreign');
            $table->dropColumn('sleep_type_id');
        });

        Schema::dropIfExists('sleep_types');
    }

    public function down(): void
    {
        //
    }
};
