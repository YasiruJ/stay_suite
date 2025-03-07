<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gimanhal_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->double('fee')->default(12);
            $table->enum('method', ['percentage', 'fixed_rate']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gimanhal_fees');
    }
};
