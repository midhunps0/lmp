<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authenticables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('authenticable_id');
            $table->string('authenticable_type');
            $table->string('name');
            $table->string('credentials');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authenticables');
    }
};
