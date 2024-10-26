<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;

class Review extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'charge',
        'date_review',
        'review',
        'stars',
    ];

    public static function getFillableFields($validatedFields, Request $request, Review $entity = null)
    {
        return [
            'name' => $validatedFields['name'] ?? null,
            'charge' => $validatedFields['charge'] ?? null,
            'date_review' => $validatedFields['date_review'] ?? null,
            'review' => $validatedFields['review'] ?? null,
            'stars' => $validatedFields['stars'] ?? null,
        ];
    }

    public static function getRoutes(){
        return [
            'store' => 'reviews.store',
            'update' => 'reviews.update',
            'destroy'=>'reviews.destroy'
        ];
    }

    /**
     * Get Routes to redirect.
     */
     public static function getRedirectRoutes($route="index"){

         if($route == "index"){

            return "dashboard.web-content";

         }elseif($route == "store" || $route == "update"){

            return "dashboard_web_review";
         }


         return "dashboard_web_review";
    }


    /**
     * Get validation rules for creating or updating a review.
     */
    public static function getValidationRules($isUpdate = false)
    {
        return [
            'name' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'charge' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'date_review' => $isUpdate ? 'sometimes|required|date' : 'required|date',
            'review' => $isUpdate ? 'sometimes|required|string|max:500' : 'required|string|max:500',
            'stars' => $isUpdate ? 'sometimes|required|integer|min:1|max:5' : 'required|integer|min:1|max:5',
        ];
    }

    public static function getValidationMessages()
    {
        return [
            'name.required' => __('messages.dashboard.web.review.form.validations.name_required'),
            'name.string' => __('messages.dashboard.web.review.form.validations.name_string'),
            'name.max' => __('messages.dashboard.web.review.form.validations.name_max'),
            'charge.required' => __('messages.dashboard.web.review.form.validations.charge_required'),
            'charge.string' => __('messages.dashboard.web.review.form.validations.charge_string'),
            'charge.max' => __('messages.dashboard.web.review.form.validations.charge_max'),
            'date_review.required' => __('messages.dashboard.web.review.form.validations.date_review_required'),
            'date_review.date' => __('messages.dashboard.web.review.form.validations.date_review_date'),
            'review.required' => __('messages.dashboard.web.review.form.validations.review_required'),
            'review.string' => __('messages.dashboard.web.review.form.validations.review_string'),
            'review.max' => __('messages.dashboard.web.review.form.validations.review_max'),
            'stars.required' => __('messages.dashboard.web.review.form.validations.stars_required'),
            'stars.integer' => __('messages.dashboard.web.review.form.validations.stars_integer'),
            'stars.min' => __('messages.dashboard.web.review.form.validations.stars_min'),
            'stars.max' => __('messages.dashboard.web.review.form.validations.stars_max'),
        ];
    }

    /**
     * Get success messages for CRUD operations.
     */
    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.web.review.form.success.create',
            'update' => 'messages.dashboard.web.review.form.success.update',
            'delete' => 'messages.dashboard.web.review.form.success.delete',
        ];
        // Return the translated message using __() helper
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    /**
     * Get error messages for CRUD operations.
     */
    public static function getErrorMessage($action)
    {
        $messages = [
            'not_found' => 'messages.dashboard.web.review.form.error.not_found',
            'validation_failed' => 'messages.dashboard.web.review.form.error.validation_failed',
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    public static function getHelperMessages(){

        return [
            'delete_header' => __('messages.dashboard.web.review.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.web.review.form.modal.delete_content'),
        ];

    }

    public static function getType(): string
    {
        return 'review';
    }

    /**
     * Serialize the Review model into a JSON string.
     *
     * @return string
     */
    public static function filterFields():array
    {
        return [
            [
                'label' => 'messages.dashboard.web.review.dropdown.name',
                'value' => 'name',
            ],
            [
                'label' => 'messages.dashboard.web.review.dropdown.charge',
                'value' => 'charge',
            ],
            [
                'label' => 'messages.dashboard.web.review.dropdown.review',
                'value' => 'review',
            ],
            [
                'label' => 'messages.dashboard.web.review.dropdown.stars',
                'value' => 'stars',
            ],
        ];
    }

    /**
     * Serialize the Review model into a JSON string.
     *
     * @return string
     */
    public function serialize(): string
    {
        return json_encode([
            'name' => $this->name,
            'charge' => $this->charge,
            'date_review' => $this->date_review,
            'review' => $this->review,
            'stars' => $this->stars,
        ]);
    }

    /**
     * Deserialize a JSON string into a Review object.
     *
     * @param string $json
     * @return Review
     */
    public static function deserialize(string $json): Review
    {
        $data = json_decode($json, true);

        // Create a new Review instance with the deserialized data
        return new self([
            'name' => $data['name'],
            'charge' => $data['charge'],
            'date_review' => $data['date_review'],
            'review' => $data['review'],
            'stars' => $data['stars'],
        ]);
    }
}
