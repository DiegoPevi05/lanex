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
        Schema::create('tracking_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('transport_type_id')->constrained('transport_types')->onDelete('cascade');
            $table->string('status')->default('PENDING'); // e.g., "Pending", "In Transit", "Completed"
            $table->unsignedInteger('sequence')->comment('Order of this step in the tracking sequence');
            $table->string('country')->nullable(); // e.g., "Warehouse"
            $table->string('city')->nullable(); // e.g., "Port"
            $table->string('address')->nullable(); // e.g., "Port"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_steps');
    }
};
