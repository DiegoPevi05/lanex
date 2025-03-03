<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class WebBlog extends Model
{
    use HasFactory;

    protected $table = 'web_blogs';

    protected $fillable = [
        'title',
        'excerpt',               // Short summary of the content
        'content',               // Main content
        'meta_description',      // SEO meta description
        'meta_keywords',         // SEO meta keywords
        'featured_image',        // Main blog image
        'thumbnail_image',       // Smaller version for listings
        'author',               // Author of the blog
        'category',             // Category of the blog
        'status',               // draft, published, archived
        'is_featured',          // Boolean to feature posts
        'view_count',           // Number of views
        'reading_time',         // Estimated reading time in minutes
        'published_at',         // Schedule post publication
        'seo_title',            // SEO-optimized title
        'header_type',          // normal, video, slideshow, etc.
        'sub_header',           // Secondary headline
        'tags',                 // JSON array of tags
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public static function castFields($entity)
    {
        $entity->tags = isset($entity->tags) ? json_decode($entity->tags, true) : null;
        $entity->content = isset($entity->content) ? json_decode($entity->content, true) : null;
    }


    public static function getFillableFields($validatedFields, Request $request, WebBlog $entity = null)
    {
        // Helper function for image processing
        $processImage = function ($imageFieldPath, $currentImagePath) use ($request) {
            if ($request->hasFile($imageFieldPath)) {
                return ImageUploadService::storeOrReplaceImage(
                    $request->file($imageFieldPath),
                    self::getType(),
                    $currentImagePath
                );
            }
            return $currentImagePath;
        };

        return [
            'title' => $validatedFields['title'] ?? null,
            'excerpt' => $validatedFields['excerpt'] ?? null,
            'content' =>  isset($validatedFields['content']) ? json_encode($validatedFields['content']) : json_encode([]),
            'meta_description' => $validatedFields['meta_description'] ?? null,
            'meta_keywords' => $validatedFields['meta_keywords'] ?? null,
            'featured_image' => $processImage('featured_image', $entity ? $entity->featured_image : null),
            'thumbnail_image' => $processImage('thumbnail_image', $entity ? $entity->thumbnail_image : null),
            'author' => $validatedFields['author'] ?? null,
            'category' => $validatedFields['category'] ?? null,
            'status' => $validatedFields['status'] ?? 'draft',
            'is_featured' => $validatedFields['is_featured'] ?? false,
            'reading_time' => $validatedFields['reading_time'] ?? null,
            'published_at' => $validatedFields['published_at'] ?? null,
            'seo_title' => $validatedFields['seo_title'] ?? null,
            'header_type' => $validatedFields['header_type'] ?? 'normal',
            'sub_header' => $validatedFields['sub_header'] ?? null,
            'tags' => isset($validatedFields['tags']) ? json_encode($validatedFields['tags']) : json_encode([]),
        ];
    }

    public static function getValidationRules($isUpdate = false)
    {
        return [
            'title' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => $isUpdate ? 'sometimes|required|array' : 'required|array',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'category' => 'required|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'reading_time' => 'nullable|integer|min:1',
            'published_at' => 'nullable|date',
            'seo_title' => 'nullable|string|max:255',
            'header_type' => 'required|in:normal,video,slideshow',
            'sub_header' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
        ];
    }

    public static function getValidationMessages()
    {
        return [
            'title.required' => __('messages.dashboard.web.blog.form.validations.title_required'),
            'title.string' => __('messages.dashboard.web.blog.form.validations.title_string'),
            'title.max' => __('messages.dashboard.web.blog.form.validations.title_max'),

            'excerpt.string' => __('messages.dashboard.web.blog.form.validations.excerpt_string'),
            'excerpt.max' => __('messages.dashboard.web.blog.form.validations.excerpt_max'),

            'content.required' => __('messages.dashboard.web.blog.form.validations.content_required'),
            'content.array' => __('messages.dashboard.web.blog.form.validations.content_array'),

            'meta_description.string' => __('messages.dashboard.web.blog.form.validations.meta_description_string'),
            'meta_description.max' => __('messages.dashboard.web.blog.form.validations.meta_description_max'),

            'meta_keywords.string' => __('messages.dashboard.web.blog.form.validations.meta_keywords_string'),
            'meta_keywords.max' => __('messages.dashboard.web.blog.form.validations.meta_keywords_max'),

            'featured_image.image' => __('messages.dashboard.web.blog.form.validations.featured_image_image'),
            'featured_image.mimes' => __('messages.dashboard.web.blog.form.validations.featured_image_mimes'),
            'featured_image.max' => __('messages.dashboard.web.blog.form.validations.featured_image_max'),

            'thumbnail_image.image' => __('messages.dashboard.web.blog.form.validations.thumbnail_image_image'),
            'thumbnail_image.mimes' => __('messages.dashboard.web.blog.form.validations.thumbnail_image_mimes'),
            'thumbnail_image.max' => __('messages.dashboard.web.blog.form.validations.thumbnail_image_max'),

            'author.required' => __('messages.dashboard.web.blog.form.validations.author_required'),
            'author.string' => __('messages.dashboard.web.blog.form.validations.author_string'),

            'category.required' => __('messages.dashboard.web.blog.form.validations.category_required'),
            'category.string' => __('messages.dashboard.web.blog.form.validations.category_string'),
            'category.max' => __('messages.dashboard.web.blog.form.validations.category_max'),

            'status.required' => __('messages.dashboard.web.blog.form.validations.status_required'),
            'status.in' => __('messages.dashboard.web.blog.form.validations.status_in'),

            'is_featured.boolean' => __('messages.dashboard.web.blog.form.validations.is_featured_boolean'),

            'reading_time.integer' => __('messages.dashboard.web.blog.form.validations.reading_time_integer'),
            'reading_time.min' => __('messages.dashboard.web.blog.form.validations.reading_time_min'),

            'published_at.date' => __('messages.dashboard.web.blog.form.validations.published_at_date'),

            'seo_title.string' => __('messages.dashboard.web.blog.form.validations.seo_title_string'),
            'seo_title.max' => __('messages.dashboard.web.blog.form.validations.seo_title_max'),

            'header_type.required' => __('messages.dashboard.web.blog.form.validations.header_type_required'),
            'header_type.in' => __('messages.dashboard.web.blog.form.validations.header_type_in'),

            'sub_header.string' => __('messages.dashboard.web.blog.form.validations.sub_header_string'),
            'sub_header.max' => __('messages.dashboard.web.blog.form.validations.sub_header_max'),

            'tags.array' => __('messages.dashboard.web.blog.form.validations.tags_array'),
          ];
    }

    public static function getSuccessMessage($action)
    {
        $messages =  [
            'store' => __('messages.dashboard.web.blog.form.success.store'),
            'update' => __('messages.dashboard.web.blog.form.success.update'),
            'destroy' => __('messages.dashboard.web.blog.form.success.destroy'),
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    public static function getErrorMessage($action)
    {
        $messages =  [
            'not_found' => __('messages.dashboard.web.blog.form.error.not_found'),
            'validation_failed' => __('messages.dashboard.web.blog.form.error.validation_failed'),
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    public static function getHelperMessages()
    {
        return [
            'delete_header' => __('messages.dashboard.web.blog.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.web.blog.form.modal.delete_content'),
        ];
    }

    public static function filterFields():array
    {
        return [
            [
                'label' => __('messages.dashboard.web.blog.form.fields.title'),
                'value' => 'title',
            ],
            [
                'label' => __('messages.dashboard.web.blog.form.fields.author'),
                'value' => 'author',
            ],
            [
                'label' => __('messages.dashboard.web.blog.form.fields.category'),
                'value' => 'category',
            ],
            [
                'label' => __('messages.dashboard.web.blog.form.fields.status'),
                'value' => 'status',
            ],

        ];
    }

    public static function getRoutes()
    {
        return [
            'store' => 'blogs.store',
            'update' => 'blogs.update',
            'destroy' => 'blogs.destroy'
        ];
    }

    public static function getRedirectRoutes($route = "index")
    {
        if ($route == "index") {
            return "dashboard.web-content";
        } elseif ($route == "store" || $route == "update") {
            return "dashboard_web_blog";
        }
        return "dashboard_web_blog";
    }

    public static function getType(): string
    {
        return 'blog';
    }
}
