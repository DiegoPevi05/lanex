<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'short_description',
        'webcontent'
    ];

    /**
     * Get fillable fields.
     */
    public static function getFillableFields($validatedFields, Request $request, Service $entity = null)
    {

        // Helper function for image processing
        $processImage = function ($imageFieldPath, $currentImagePath) use ($request) {
            // Check if an image is present in the request
            if ($request->hasFile($imageFieldPath)) {
                return ImageUploadService::storeOrReplaceImage(
                    $request->file($imageFieldPath),
                    self::getType(),
                    $currentImagePath
                );
            }

            // If no file, return the current image path
            return $currentImagePath;
        };

        return [
            'name' => $validatedFields['name'] ?? null,
            'icon' => $validatedFields['icon'] ?? null,
            'short_description' => $validatedFields['short_description'] ?? null,
            'webcontent' => json_encode([
                'header' => $validatedFields['webcontent']['header'] ?? '',
                'image' => $processImage('webcontent.image', $entity ? json_decode($entity->webcontent)->image : null),
                'title' => $validatedFields['webcontent']['title'] ?? '',
                'description' => $validatedFields['webcontent']['description'] ?? '',
                'overview' => [
                    'header' => $validatedFields['webcontent']['overview']['header'] ?? '',
                    'title' => $validatedFields['webcontent']['overview']['title'] ?? '',
                    'image' => $processImage('webcontent.overview.image', $entity ? json_decode($entity->webcontent)->overview->image : null),
                    'content' => [
                        'header' => $validatedFields['webcontent']['overview']['content']['header'] ?? '',
                        'introduction' => $validatedFields['webcontent']['overview']['content']['introduction'] ?? '',
                        'content' => $validatedFields['webcontent']['overview']['content']['content'] ?? '',
                    ],
                ],
                'content_link' => [
                    'header' => $validatedFields['webcontent']['content_link']['header'] ?? '',
                    'title' => $validatedFields['webcontent']['content_link']['title'] ?? '',
                    'button_label' => $validatedFields['webcontent']['content_link']['button_label'] ?? '',
                    'image' => $processImage('webcontent.content_link.image', $entity ? json_decode($entity->webcontent)->content_link->image : null),
                    'content' => $validatedFields['webcontent']['content_link']['content'] ?? '',
                ],
                'keypoints' => [
                    'header' => $validatedFields['webcontent']['keypoints']['header'] ?? '',
                    'title' => $validatedFields['webcontent']['keypoints']['title'] ?? '',
                    'points' => $validatedFields['webcontent']['keypoints']['points'] ?? [],
                ],
                'faqs' => [
                    'title' => $validatedFields['webcontent']['faqs']['title'] ?? '',
                    'questions' => $validatedFields['webcontent']['faqs']['questions'] ?? [],
                ],
            ]),
        ];
    }

    /**
     * Define the routes for CRUD operations.
     */
    public static function getRoutes()
    {
        return [
            'store' => 'services.store',
            'update' => 'services.update',
            'destroy' => 'services.destroy'
        ];
    }

    /**
     * Get redirect routes for different CRUD operations.
     */
    public static function getRedirectRoutes($route = "index")
    {
        if ($route == "index") {
            return "dashboard.web-content";
        } elseif ($route == "store" || $route == "update") {
            return "dashboard_web_service";
        }

        return "dashboard_web_service";
    }

    /**
     * Get validation rules for creating or updating a service.
     */
    public static function getValidationRules($isUpdate = false)
    {
        return [
            'name' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'icon' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'short_description' => $isUpdate ? 'sometimes|required|string|max:500' : 'required|string|max:500',
            'webcontent' => $isUpdate ? 'sometimes|required|array' : 'required|array',
            'webcontent.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Updated for image validation
            'webcontent.header' => 'required|string|max:30',
            'webcontent.title' => 'required|string|max:50',
            'webcontent.description' => 'required|string|max:200',

            // Overview nested fields
            'webcontent.overview.header' => 'required|string|max:20',
            'webcontent.overview.title' => 'required|string|max:50',
            'webcontent.overview.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Updated for image validation
            'webcontent.overview.content.header' => 'required|string|max:200',
            'webcontent.overview.content.introduction' => 'required|string|max:400',
            'webcontent.overview.content.content' => 'required|string|max:600',

            // Content link nested fields
            'webcontent.content_link.header' => 'required|string|max:20',
            'webcontent.content_link.title' => 'required|string|max:40',
            'webcontent.content_link.button_label' => 'required|string|max:30',
            'webcontent.content_link.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Updated for image validation
            'webcontent.content_link.content' => 'required|string|max:400',

            // Keypoints nested fields
            'webcontent.keypoints.header' => 'required|string|max:30',
            'webcontent.keypoints.title' => 'required|string|max:50',
            'webcontent.keypoints.points' => 'required|array|min:1|max:6',
            'webcontent.keypoints.points.*.title' => 'required|string|max:30', // Title for each point
            'webcontent.keypoints.points.*.content' => 'required|string|max:400', // Content for each point

            // FAQs nested fields
            'webcontent.faqs.title' => 'required|string|max:50',
            'webcontent.faqs.questions' => 'required|array|min:1|max:6',
            'webcontent.faqs.questions.*.question' => 'required|string|max:100',
            'webcontent.faqs.questions.*.answer' => 'required|string|max:400',
        ];
    }

    /**
     * Get validation rules for creating or updating a service.
     */
    public static function getValidationMessages()
    {
        return [
            'name.required' => __('messages.dashboard.web.service.form.validations.name_required'),
            'name.string' => __('messages.dashboard.web.service.form.validations.name_string'),
            'name.max' => __('messages.dashboard.web.service.form.validations.name_max'),
            'icon.required' => __('messages.dashboard.web.service.form.validations.icon_required'),
            'icon.string' => __('messages.dashboard.web.service.form.validations.icon_string'),
            'icon.max' => __('messages.dashboard.web.service.form.validations.icon_max'),
            'short_description.required' => __('messages.dashboard.web.service.form.validations.short_description_required'),
            'short_description.string' => __('messages.dashboard.web.service.form.validations.short_description_string'),
            'short_description.max' => __('messages.dashboard.web.service.form.validations.short_description_max'),

            'webcontent.required' => __('messages.dashboard.web.service.form.validations.webcontent_required'),
            'webcontent.array' => __('messages.dashboard.web.service.form.validations.webcontent_array'),

            'webcontent.image.image' => __('messages.dashboard.web.service.form.validations.webcontent_image_image'),
            'webcontent.image.mimes' => __('messages.dashboard.web.service.form.validations.webcontent_image_mimes'),
            'webcontent.image.max' => __('messages.dashboard.web.service.form.validations.webcontent_image_max'),

            'webcontent.header.required' => __('messages.dashboard.web.service.form.validations.webcontent_header_required'),
            'webcontent.header.string' => __('messages.dashboard.web.service.form.validations.webcontent_header_string'),
            'webcontent.header.max' => __('messages.dashboard.web.service.form.validations.webcontent_header_max'),

            'webcontent.title.required' => __('messages.dashboard.web.service.form.validations.webcontent_title_required'),
            'webcontent.title.string' => __('messages.dashboard.web.service.form.validations.webcontent_title_string'),
            'webcontent.title.max' => __('messages.dashboard.web.service.form.validations.webcontent_title_max'),

            'webcontent.description.required' => __('messages.dashboard.web.service.form.validations.webcontent_description_required'),
            'webcontent.description.string' => __('messages.dashboard.web.service.form.validations.webcontent_description_string'),
            'webcontent.description.max' => __('messages.dashboard.web.service.form.validations.webcontent_description_max'),

            // Overview Section
            'webcontent.overview.header.required' => __('messages.dashboard.web.service.form.validations.overview_header_required'),
            'webcontent.overview.header.string' => __('messages.dashboard.web.service.form.validations.overview_header_string'),
            'webcontent.overview.header.max' => __('messages.dashboard.web.service.form.validations.overview_header_max'),

            'webcontent.overview.title.required' => __('messages.dashboard.web.service.form.validations.overview_title_required'),
            'webcontent.overview.title.string' => __('messages.dashboard.web.service.form.validations.overview_title_string'),
            'webcontent.overview.title.max' => __('messages.dashboard.web.service.form.validations.overview_title_max'),

            'webcontent.overview.image.image' => __('messages.dashboard.web.service.form.validations.webcontent_overview_image_image'),
            'webcontent.overview.image.mimes' => __('messages.dashboard.web.service.form.validations.webcontent_overview_image_mimes'),
            'webcontent.overview.image.max' => __('messages.dashboard.web.service.form.validations.webcontent_overview_image_max'),

            'webcontent.overview.content.header.required' => __('messages.dashboard.web.service.form.validations.overview_content_header_required'),
            'webcontent.overview.content.header.string' => __('messages.dashboard.web.service.form.validations.overview_content_header_string'),
            'webcontent.overview.content.header.max' => __('messages.dashboard.web.service.form.validations.overview_content_header_max'),

            'webcontent.overview.content.introduction.required' => __('messages.dashboard.web.service.form.validations.overview_content_introduction_required'),
            'webcontent.overview.content.introduction.string' => __('messages.dashboard.web.service.form.validations.overview_content_introduction_string'),
            'webcontent.overview.content.introduction.max' => __('messages.dashboard.web.service.form.validations.overview_content_introduction_max'),

            'webcontent.overview.content.content.required' => __('messages.dashboard.web.service.form.validations.overview_content_content_required'),
            'webcontent.overview.content.content.string' => __('messages.dashboard.web.service.form.validations.overview_content_content_string'),
            'webcontent.overview.content.content.max' => __('messages.dashboard.web.service.form.validations.overview_content_content_max'),

            // Content Link Section
            'webcontent.content_link.header.required' => __('messages.dashboard.web.service.form.validations.content_link_header_required'),
            'webcontent.content_link.header.string' => __('messages.dashboard.web.service.form.validations.content_link_header_string'),
            'webcontent.content_link.header.max' => __('messages.dashboard.web.service.form.validations.content_link_header_max'),

            'webcontent.content_link.title.required' => __('messages.dashboard.web.service.form.validations.content_link_title_required'),
            'webcontent.content_link.title.string' => __('messages.dashboard.web.service.form.validations.content_link_title_string'),
            'webcontent.content_link.title.max' => __('messages.dashboard.web.service.form.validations.content_link_title_max'),

            'webcontent.content_link.button_label.required' => __('messages.dashboard.web.service.form.validations.content_link_button_label_required'),
            'webcontent.content_link.button_label.string' => __('messages.dashboard.web.service.form.validations.content_link_button_label_string'),
            'webcontent.content_link.button_label.max' => __('messages.dashboard.web.service.form.validations.content_link_button_label_max'),

            'webcontent.content_link.image.image' => __('messages.dashboard.web.service.form.validations.webcontent_content_link_image_image'),
            'webcontent.content_link.image.mimes' => __('messages.dashboard.web.service.form.validations.webcontent_content_link_image_mimes'),
            'webcontent.content_link.image.max' => __('messages.dashboard.web.service.form.validations.webcontent_content_link_image_max'),

            'webcontent.content_link.content.required' => __('messages.dashboard.web.service.form.validations.content_link_content_required'),
            'webcontent.content_link.content.string' => __('messages.dashboard.web.service.form.validations.content_link_content_string'),
            'webcontent.content_link.content.max' => __('messages.dashboard.web.service.form.validations.content_link_content_max'),

            // Keypoints Section
            'webcontent.keypoints.header.required' => __('messages.dashboard.web.service.form.validations.keypoints_header_required'),
            'webcontent.keypoints.header.string' => __('messages.dashboard.web.service.form.validations.keypoints_header_string'),
            'webcontent.keypoints.header.max' => __('messages.dashboard.web.service.form.validations.keypoints_header_max'),

            'webcontent.keypoints.title.required' => __('messages.dashboard.web.service.form.validations.keypoints_title_required'),
            'webcontent.keypoints.title.string' => __('messages.dashboard.web.service.form.validations.keypoints_title_string'),
            'webcontent.keypoints.title.max' => __('messages.dashboard.web.service.form.validations.keypoints_title_max'),

            'webcontent.keypoints.points.required' => __('messages.dashboard.web.service.form.validations.keypoints_points_required'),
            'webcontent.keypoints.points.array' => __('messages.dashboard.web.service.form.validations.keypoints_points_array'),
            'webcontent.keypoints.points.*.required' => __('messages.dashboard.web.service.form.validations.keypoints_points_item_required'),
            'webcontent.keypoints.points.*.string' => __('messages.dashboard.web.service.form.validations.keypoints_points_item_string'),
            'webcontent.keypoints.points.*.max' => __('messages.dashboard.web.service.form.validations.keypoints_points_item_max'),

            'webcontent.keypoints.points.*.title.required' => __('messages.dashboard.web.service.form.validations.webcontent_keypoints_points_title_required'),
                'webcontent.keypoints.points.*.title.string' => __('messages.dashboard.web.service.form.validations.webcontent_keypoints_points_title_string'),
                'webcontent.keypoints.points.*.title.max' => __('messages.dashboard.web.service.form.validations.webcontent_keypoints_points_title_max'),

            'webcontent.keypoints.points.*.content.required' => __('messages.dashboard.web.service.form.validations.webcontent_keypoints_points_content_required'),
                'webcontent.keypoints.points.*.content.string' => __('messages.dashboard.web.service.form.validations.webcontent_keypoints_points_content_string'),
                'webcontent.keypoints.points.*.content.max' => __('messages.dashboard.web.service.form.validations.webcontent_keypoints_points_content_max'),

            // FAQs Section
            'webcontent.faqs.title.required' => __('messages.dashboard.web.service.form.validations.faqs_title_required'),
            'webcontent.faqs.title.string' => __('messages.dashboard.web.service.form.validations.faqs_title_string'),
            'webcontent.faqs.title.max' => __('messages.dashboard.web.service.form.validations.faqs_title_max'),

            'webcontent.faqs.questions.required' => __('messages.dashboard.web.service.form.validations.faqs_questions_required'),
            'webcontent.faqs.questions.array' => __('messages.dashboard.web.service.form.validations.faqs_questions_array'),
            // FAQs questions ID validation messages
            'webcontent.faqs.questions.*.id.required' => __('messages.dashboard.web.service.form.validations.webcontent_faqs_questions_id_required'),
            'webcontent.faqs.questions.*.id.integer' => __('messages.dashboard.web.service.form.validations.webcontent_faqs_questions_id_integer'),

            // FAQs questions question validation messages
            'webcontent.faqs.questions.*.question.required' => __('messages.dashboard.web.service.form.validations.webcontent_faqs_questions_question_required'),
            'webcontent.faqs.questions.*.question.string' => __('messages.dashboard.web.service.form.validations.webcontent_faqs_questions_question_string'),
            'webcontent.faqs.questions.*.question.max' => __('messages.dashboard.web.service.form.validations.webcontent_faqs_questions_question_max'),

            // FAQs questions answer validation messages
            'webcontent.faqs.questions.*.answer.required' => __('messages.dashboard.web.service.form.validations.webcontent_faqs_questions_answer_required'),
            'webcontent.faqs.questions.*.answer.string' => __('messages.dashboard.web.service.form.validations.webcontent_faqs_questions_answer_string'),
            'webcontent.faqs.questions.*.answer.max' => __('messages.dashboard.web.service.form.validations.webcontent_faqs_questions_answer_max'),
        ];
    }

    /**
     * Success messages for CRUD operations.
     */
    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.web.service.form.success.create',
            'update' => 'messages.dashboard.web.service.form.success.update',
            'delete' => 'messages.dashboard.web.service.form.success.delete',
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    /**
     * Error messages for CRUD operations.
     */
    public static function getErrorMessage($action)
    {
        $messages = [
            'not_found' => 'messages.dashboard.web.service.form.error.not_found',
            'validation_failed' => 'messages.dashboard.web.service.form.error.validation_failed',
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    /**
     * Helper messages for displaying modals, etc.
     */
    public static function getHelperMessages()
    {
        return [
            'delete_header' => __('messages.dashboard.web.service.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.web.service.form.modal.delete_content'),
        ];
    }

    /**
     * Get the entity type.
     */
    public static function getType(): string
    {
        return 'service';
    }

    /**
     * Define filterable fields for the service model.
     */
    public static function filterFields(): array
    {
        return [
            [
                'label' => 'messages.dashboard.web.service.dropdown.name',
                'value' => 'name',
            ],
            [
                'label' => 'messages.dashboard.web.service.dropdown.short_description',
                'value' => 'short_description',
            ],
        ];
    }

    /**
     * Serialize the Service model into a JSON string.
     */
    public function serialize(): string
    {
        return json_encode([
            'name' => $this->name,
            'icon' => $this->icon,
            'short_description' => $this->short_description,
            'webcontent' => $this->webcontent,
        ]);
    }

    /**
     * Deserialize a JSON string into a Service object.
     */
    public static function deserialize(string $json): Service
    {
        $data = json_decode($json, true);

        return new self([
            'name' => $data['name'],
            'icon' => $data['icon'],
            'short_description' => $data['short_description'],
            'webcontent' => $data['webcontent'],
        ]);
    }

    /**
     * Define the relationship with the Supplier model.
     */
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }
}
