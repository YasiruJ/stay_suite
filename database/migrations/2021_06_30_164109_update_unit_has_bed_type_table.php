<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('unit_has_bed_type', function (Blueprint $table) {
            $table->integer('bed_count')->nullable()->after('bed_type_id');
        });
    }

    public function down()
    {
        Schema::table('unit_has_bed_type', function (Blueprint $table) {
            //
        });
    }
};
