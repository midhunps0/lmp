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
        Schema::create("clients_sources", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("client_id");
            $table->unsignedBigInteger("source_id");
            $table->foreign("client_id")->references("id")->on("clients")->onDelete("cascade");
            $table->foreign("source_id")->references("id")->on("sources")->onDelete("cascade");

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
