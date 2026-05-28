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
        Schema::table('web_services', function (Blueprint $table) {
            $table->string('icon')->nullable()->change();
            $table->string('short_description')->nullable()->change();
            $table->json('webcontent')->nullable()->change();
        });

        Schema::table('web_suppliers', function (Blueprint $table) {
            $table->string('logo')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->json('details')->nullable()->change();
        });

        Schema::table('web_products', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->unsignedTinyInteger('stars')->nullable()->change();
            $table->text('description')->nullable()->change();
        });

        Schema::table('web_blogs', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
            $table->string('author')->nullable()->change();
            $table->string('category')->nullable()->change();
        });

        Schema::table('web_reviews', function (Blueprint $table) {
            $table->string('charge')->nullable()->change();
            $table->dateTime('date_review')->nullable()->change();
            $table->text('review')->nullable()->change();
            $table->unsignedTinyInteger('stars')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_services', function (Blueprint $table) {
            $table->string('icon')->nullable(false)->change();
            $table->string('short_description')->nullable(false)->change();
            $table->json('webcontent')->nullable(false)->change();
        });

        Schema::table('web_suppliers', function (Blueprint $table) {
            $table->string('logo')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->json('details')->nullable(false)->change();
        });

        Schema::table('web_products', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change();
            $table->unsignedTinyInteger('stars')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
        });

        Schema::table('web_blogs', function (Blueprint $table) {
            $table->text('content')->nullable(false)->change();
            $table->string('author')->nullable(false)->change();
            $table->string('category')->nullable(false)->change();
        });

        Schema::table('web_reviews', function (Blueprint $table) {
            $table->string('charge')->nullable(false)->change();
            $table->dateTime('date_review')->nullable(false)->change();
            $table->text('review')->nullable(false)->change();
            $table->unsignedTinyInteger('stars')->nullable(false)->change();
        });
    }
};
