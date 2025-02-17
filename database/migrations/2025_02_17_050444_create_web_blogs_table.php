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
        Schema::table('web_blogs', function (Blueprint $table) {
            // Rename existing 'image' to 'featured_image'
            $table->renameColumn('image', 'featured_image');
            
            // Add new fields
            $table->string('slug')->unique()->after('title');
            $table->text('excerpt')->nullable()->after('slug');
            $table->string('meta_description')->nullable()->after('content');
            $table->string('meta_keywords')->nullable()->after('meta_description');
            $table->string('thumbnail_image')->nullable()->after('featured_image');
            $table->string('category')->after('author');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->after('category');
            $table->boolean('is_featured')->default(false)->after('status');
            $table->unsignedInteger('view_count')->default(0)->after('is_featured');
            $table->unsignedInteger('reading_time')->nullable()->after('view_count');
            $table->timestamp('published_at')->nullable()->after('reading_time');
            $table->string('seo_title')->nullable()->after('published_at');
            $table->enum('header_type', ['normal', 'video', 'slideshow'])->default('normal')->after('seo_title');
            $table->string('sub_header')->nullable()->after('header_type');
            $table->json('tags')->nullable()->after('sub_header');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_blogs', function (Blueprint $table) {
            // Revert the rename of 'featured_image' back to 'image'
            $table->renameColumn('featured_image', 'image');
            
            // Remove the new columns
            $table->dropColumn([
                'slug',
                'excerpt',
                'meta_description',
                'meta_keywords',
                'thumbnail_image',
                'category',
                'status',
                'is_featured',
                'view_count',
                'reading_time',
                'published_at',
                'seo_title',
                'header_type',
                'sub_header',
                'tags'
            ]);
        });
    }
};