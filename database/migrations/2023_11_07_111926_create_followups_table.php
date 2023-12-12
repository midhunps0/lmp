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
        Schema::create('followups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads');
            $table->foreignId('carried_out_by')->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('action_id')->constrained('actions');
            $table->dateTime('scheduled_date');
            $table->dateTime('actual_date');
            $table->dateTime('next_followup_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followups');
    }
};
