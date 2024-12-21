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
            $table->dateTime('eta')->nullable()->after('address')->comment('Estimated time of arrival');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracking_steps', function (Blueprint $table) {
            $table->dropColumn('eta');
        });
    }
};
