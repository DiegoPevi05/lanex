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
        Schema::create('web_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('charge');
            $table->dateTime('date_review');
            $table->text('review');
            $table->unsignedTinyInteger('stars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_reviews');
    }
};