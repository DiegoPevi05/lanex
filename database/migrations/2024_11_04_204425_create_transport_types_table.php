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
        Schema::create('transport_types', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // e.g., "Air", "Car", "Ship", etc.
            $table->string('name');
            $table->string('icon');
            $table->text('description')->nullable();
            $table->string('status')->default('ACTIVE'); // ACTIVE - INACTIVE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_types');
    }
};
