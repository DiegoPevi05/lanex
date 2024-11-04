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
        Schema::create('web_service_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('web_services')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('web_suppliers')->onDelete('cascade');
            $table->timestamps(); // Optional, but useful for tracking the relationship creation time
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_service_supplier');
    }
};
