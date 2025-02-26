<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    /** to clean the table */
    //php artisan db:seed --class=TruncateWebBlogsSeeder
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('web_blogs', function (Blueprint $table) {
            $table->json('content')->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_blogs', function (Blueprint $table) {
            $table->text('content')->change();
        });
    }
};