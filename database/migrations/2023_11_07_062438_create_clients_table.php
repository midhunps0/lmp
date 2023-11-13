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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('isValid')->default(true);
            $table->unsignedBigInteger('subscription_model_id')->nullable();
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->unsignedBigInteger('managing_person_id')->nullable();
            $table->unsignedBigInteger('stage_id')->default(1);
            $table->unsignedBigInteger('segment_id')->default(1);
            $table->timestamp('email_verified_at')->nullable();

            $table->foreign('subscription_model_id')->references('id')->on('subscription_models');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('segment_id')->references('id')->on('segments');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
