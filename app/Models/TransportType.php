<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TransportType extends Model
{
    use HasFactory;

    protected $table = 'transport_types';

    protected $fillable = [
        'type',
        'name',
        'icon',
        'description',
        'status',
        'external_reference'
    ];

    public static function getType(): string
    {
        return 'transport_type';
    }

    public static function getFillableFields($validatedFields, Request $request, TransportType $entity = null)
    {
        // Process the fillable fields
        $fillableFields = [
            'type' => $validatedFields['type'] ?? null,
            'name' => $validatedFields['name'] ?? null,
            'icon' => $validatedFields['icon'] ?? null,
            'status' => $validatedFields['status'] ?? 'ACTIVE',
            'description' => $validatedFields['description'] ?? null,
            'external_reference' => $validatedFields['external_reference'] ?? null,
        ];

        return $fillableFields;

    }

    public static function getRoutes(){
        return [
            'store' => 'transport_type.store',
            'update' => 'transport_type.update',
            'destroy'=>'transport_type.destroy'
        ];
    }

    /**
     * Get Routes to redirect.
     */
     public static function getRedirectRoutes($route="index"){

         if($route == "index"){

            return "dashboard.content";

         }elseif($route == "store" || $route == "update"){

            return "dashboard_transport_type";
         }


         return "dashboard_transport_type";
    }

    /**
     * Get validation rules for creating or updating a review.
     */
    public static function getValidationRules($isUpdate = false)
    {
        return [

            'transports' => 'required|array|min:1',
            'transports.*.country' => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
            'transports.*.city' => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
            'transports.*.address' => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
            'transports.*.type' => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
            'transports.*.icon' => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
            'transports.*.name' => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
            'transports.*.description' => $isUpdate ? 'sometimes|required|string|max:500' : 'required|string|max:500',

            'transports.*.external_reference' => 'nullable|string|max:255',
            'transports.*.status' => $isUpdate ? 'sometimes|required|string|max:255|in:ACTIVE,INACTIVE' : 'required|string|max:255|in:ACTIVE,INACTIVE',
        ];
    }

    public static function getValidationMessages()
    {
        return [

            'transports.required' => __('messages.dashboard.transport_type.form.validations.transports_required'),
            'transports.array' => __('messages.dashboard.transport_type.form.validations.transports_array'),
            'transports.min' => __('messages.dashboard.transport_type.form.validations.transports_min'),

            'transports.*.country.required' => __('messages.dashboard.transport_type.form.validations.country_required'),
            'transports.*.country.string' => __('messages.dashboard.transport_type.form.validations.country_string'),
            'transports.*.country.max' => __('messages.dashboard.transport_type.form.validations.country_max'),

            'transports.*.city.required' => __('messages.dashboard.transport_type.form.validations.city_required'),
            'transports.*.city.string' => __('messages.dashboard.transport_type.form.validations.city_string'),
            'transports.*.city.max' => __('messages.dashboard.transport_type.form.validations.city_max'),

            'transports.*.address.required' => __('messages.dashboard.transport_type.form.validations.address_required'),
            'transports.*.address.string' => __('messages.dashboard.transport_type.form.validations.address_string'),
            'transports.*.address.max' => __('messages.dashboard.transport_type.form.validations.address_max'),

            'transports.*.type.required' => __('messages.dashboard.transport_type.form.validations.type_required'),
            'transports.*.type.string' => __('messages.dashboard.transport_type.form.validations.type_string'),
            'transports.*.type.max' => __('messages.dashboard.transport_type.form.validations.type_max'),

            'transports.*.icon.required' => __('messages.dashboard.transport_type.form.validations.icon_required'),
            'transports.*.icon.string' => __('messages.dashboard.transport_type.form.validations.icon_string'),
            'transports.*.icon.max' => __('messages.dashboard.transport_type.form.validations.icon_max'),

            'transports.*.name.required' => __('messages.dashboard.transport_type.form.validations.name_required'),
            'transports.*.name.string' => __('messages.dashboard.transport_type.form.validations.name_string'),
            'transports.*.name.max' => __('messages.dashboard.transport_type.form.validations.name_max'),

            'transports.*.description.required' => __('messages.dashboard.transport_type.form.validations.description_required'),
            'transports.*.description.string' => __('messages.dashboard.transport_type.form.validations.description_string'),
            'transports.*.description.max' => __('messages.dashboard.transport_type.form.validations.description_max'),

            'transports.*.external_reference.string' => __('messages.dashboard.transport_type.form.validations.external_reference_string'),
            'transports.*.external_reference.max' => __('messages.dashboard.transport_type.form.validations.external_reference_max'),

            'transports.*.status.required' => __('messages.dashboard.transport_type.form.validations.status_required'),
            'transports.*.status.string' => __('messages.dashboard.transport_type.form.validations.status_string'),
            'transports.*.status.max' => __('messages.dashboard.transport_type.form.validations.status_max'),
            'transports.*.status.in' => __('messages.dashboard.transport_type.form.validations.status_in'),

        ];
    }

    /**
     * Get success messages for CRUD operations.
     */
    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.transport_type.form.success.create',
            'update' => 'messages.dashboard.transport_type.form.success.update',
            'delete' => 'messages.dashboard.transport_type.form.success.delete',
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
            'not_found' => 'messages.dashboard.transport_type.form.error.not_found',
            'validation_failed' => 'messages.dashboard.transport_type.form.error.validation_failed',
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    public static function getHelperMessages(){

        return [
            'delete_header' => __('messages.dashboard.transport_type.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.transport_type.form.modal.delete_content'),
        ];

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
                'label' => 'messages.dashboard.transport_type.dropdown.name',
                'value' => 'name',
            ],
            [
                'label' => 'messages.dashboard.transport_type.dropdown.description',
                'value' => 'description',
            ],
            [
                'label' => 'messages.dashboard.transport_type.dropdown.status',
                'value' => 'status',
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
            'type' => $this->type,
            'name' => $this->name,
            'icon' => $this->icon,
            'description' => $this->description,
            'external_reference' => $this->external_reference,
            'status' => $this->status,
        ]);
    }

    /**
     * Deserialize a JSON string into a Review object.
     *
     * @param string $json
     * @return Review
     */
    public static function deserialize(string $json):TransportType
    {
        $data = json_decode($json, true);

        // Create a new Review instance with the deserialized data
        return new self([
            'type' => $data['type'],
            'name' => $data['name'],
            'icon' => $data['icon'],
            'description' => $data['description'],
            'external_reference' => $data['external_reference'],
            'status' => $data['status'],
        ]);
    }


    public function trackingSteps()
    {
        return $this->hasMany(TrackingStep::class,'transport_type_id');
    }

}
