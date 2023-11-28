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
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('branch_id')->constrained('branches');
            $table->foreignId('stage_id')->constrained('stages');
            $table->foreignId('segment_id')->constrained('segments');
            $table->foreignId('user_id')->constrained('users');
            

            $table->string('name');
            $table->string('leadable_type');
            $table->string('notes');

           
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
