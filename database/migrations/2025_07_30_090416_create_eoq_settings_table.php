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
        Schema::create('eoq_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('ordering_cost')->default(0);
            $table->integer('storage_cost')->default(0);
            $table->integer('lead_time')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eoq_settings');
    }
};
