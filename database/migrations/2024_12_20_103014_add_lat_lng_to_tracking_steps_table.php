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
        Schema::table('tracking_steps', function (Blueprint $table) {
            $table->decimal('lat', 9, 6);
            $table->decimal('lng', 9, 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracking_steps', function (Blueprint $table) {
            $table->decimal('lat');
            $table->decimal('lng');
        });
    }
};
