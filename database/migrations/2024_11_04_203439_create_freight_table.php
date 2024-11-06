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
        Schema::create('freights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->string('origin');
            $table->string('dimensions_units')->nullable();
            $table->float('dimensions')->nullable();
            $table->string('weigth_units')->nullable();
            $table->float('weigth')->nullable();
            $table->string('volume_units')->nullable();
            $table->float('volume')->nullable();
            $table->integer('packages');
            $table->string('incoterms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freights');
    }
};
