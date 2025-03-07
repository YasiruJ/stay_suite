<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sub_rooms', function (Blueprint $table) {
            $table->dropForeign(['meals_type_id']);
            $table->dropForeign(['reservation_policy_id']);
            $table->dropColumn(['meals_type_id', 'reservation_policy_id']);
        });
    }

    public function down()
    {
        Schema::table('sub_rooms', function (Blueprint $table) {
            //
        });
    }
};
