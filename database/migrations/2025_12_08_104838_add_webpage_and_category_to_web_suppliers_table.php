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
        Schema::table('web_suppliers', function (Blueprint $table) {
            $table->string('webpage', 500)->nullable()->after('details');
            $table->string('category', 120)->nullable()->after('webpage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_suppliers', function (Blueprint $table) {
            $table->dropColumn(['webpage', 'category']);
        });
    }
};
