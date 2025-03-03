<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Reverse the migration by dropping the 'slug' column.
     */
    public function up(): void
    {
        Schema::table('web_blogs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

    /**
     * Rollback the migration by adding back the 'slug' column.
     */
    public function down(): void
    {
        Schema::table('web_blogs', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
        });
    }
};
