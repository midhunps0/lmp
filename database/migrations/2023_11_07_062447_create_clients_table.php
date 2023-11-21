<?php

use App\Models\SubscriptionModel;
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
            $table->foreignId('stage_id')->constrained('stages')->default(1);
            $table->foreignId('prioritry_level_id')->constrained('priority_levels')->default(1);
            $table->foreignId('segment_id')->constrained('segments')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['subscription_model_id']);
            $table->dropForeign(['subscription_id']);
            $table->dropForeign(['stage_id']);
            $table->dropForeign(['segment_id']);
        });
        Schema::dropIfExists('clients');
    }
};
