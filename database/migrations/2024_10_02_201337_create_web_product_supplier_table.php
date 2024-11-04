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
        Schema::create('web_product_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('web_products')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('web_suppliers')->onDelete('cascade');
            $table->timestamps(); // Optional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_product_supplier');
    }
};
