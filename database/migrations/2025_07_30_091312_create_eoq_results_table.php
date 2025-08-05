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
        Schema::create('eoq_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('total_demand');
            $table->integer('max');
            $table->integer('average');
            $table->decimal('eoq', 10, 2);
            $table->decimal('reorder_point', 10, 2);
            $table->decimal('safety_stock', 10, 2);
            $table->decimal('frequency', 10, 2);
            $table->json('stock_out_id')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eoq_results');
    }
};
