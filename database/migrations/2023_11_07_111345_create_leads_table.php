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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('stage_id');
            $table->unsignedBigInteger('segment_id');
            $table->unsignedBigInteger('user_id');

            $table->string('name');
            $table->enum('leadable_type',["Individual","Business"]);
            $table->string('notes');

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('segment_id')->references('id')->on('segments');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
