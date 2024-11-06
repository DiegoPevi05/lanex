<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    use HasFactory;

    protected $table = 'freights';

    protected $fillable = [
        'name',
        'description',
        'origin',
        'dimensions_units',
        'dimensions',
        'weigth_units',
        'weigth',
        'volume_units',
        'volume',
        'packages',
        'incoterms'
    ];

    /**
     * Get the type of the model.
     */
    public static function getType(): string
    {
        return 'freight';
    }

    /**
     * Prepare fillable fields from validated data.
     */
    public static function getFillableFields($validatedFields, Request $request, Freight $entity = null)
    {
        return [
            'name' => $validatedFields['name'] ?? null,
            'description' => $validatedFields['description'] ?? null,
            'origin' => $validatedFields['origin'] ?? null,
            'dimensions_units' => $validatedFields['dimensions_units'] ?? null,
            'dimensions' => $validatedFields['dimensions'] ?? null,
            'weight_units' => $validatedFields['weight_units'] ?? null,
            'weight' => $validatedFields['weight'] ?? null,
            'volume_units' => $validatedFields['volume_units'] ?? null,
            'volume' => $validatedFields['volume'] ?? null,
            'packages' => $validatedFields['packages'] ?? null,
            'incoterms' => $validatedFields['incoterms'] ?? null,
        ];
    }

    /**
     * Define redirection routes after actions.
     */
    public static function getRedirectRoutes($route = "index")
    {
        return match ($route) {
            'index' => 'dashboard.content',
            'store', 'update' => 'dashboard_freight',
            default => 'dashboard_freight',
        };
    }

    /**
     * Define validation rules for the freight.
     */
    public static function getValidationRules($isUpdate = false)
    {
        return [
            'name' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'description' => $isUpdate ? 'sometimes|nullable|string|max:500' : 'nullable|string|max:500',
            'origin' => $isUpdate ? 'sometimes|required|string|max:100' : 'required|string|max:100',
            'dimensions_units' => $isUpdate ? 'sometimes|required|string|max:10' : 'required|string|max:10',
            'dimensions' => $isUpdate ? 'sometimes|required|string|max:50' : 'required|string|max:50',
            'weight_units' => $isUpdate ? 'sometimes|required|string|max:10' : 'required|string|max:10',
            'weight' => $isUpdate ? 'sometimes|required|numeric' : 'required|numeric',
            'volume_units' => $isUpdate ? 'sometimes|required|string|max:10' : 'required|string|max:10',
            'volume' => $isUpdate ? 'sometimes|required|numeric' : 'required|numeric',
            'packages' => $isUpdate ? 'sometimes|required|integer' : 'required|integer',
            'incoterms' => $isUpdate ? 'sometimes|required|string|max:3' : 'required|string|max:3',
        ];
    }

    /**
     * Define custom validation messages.
     */
    public static function getValidationMessages()
    {
        return [
            'name.required' => __('messages.dashboard.freight.form.validations.name_required'),
            'name.string' => __('messages.dashboard.freight.form.validations.name_string'),
            'name.max' => __('messages.dashboard.freight.form.validations.name_max'),

            'origin.required' => __('messages.dashboard.freight.form.validations.origin_required'),
            'origin.string' => __('messages.dashboard.freight.form.validations.origin_string'),

            'dimensions_units.required' => __('messages.dashboard.freight.form.validations.dimensions_units_required'),
            'dimensions.required' => __('messages.dashboard.freight.form.validations.dimensions_required'),

            'weight_units.required' => __('messages.dashboard.freight.form.validations.weight_units_required'),
            'weight.required' => __('messages.dashboard.freight.form.validations.weight_required'),
            'weight.numeric' => __('messages.dashboard.freight.form.validations.weight_numeric'),

            'volume_units.required' => __('messages.dashboard.freight.form.validations.volume_units_required'),
            'volume.required' => __('messages.dashboard.freight.form.validations.volume_required'),
            'volume.numeric' => __('messages.dashboard.freight.form.validations.volume_numeric'),

            'packages.required' => __('messages.dashboard.freight.form.validations.packages_required'),
            'packages.integer' => __('messages.dashboard.freight.form.validations.packages_integer'),

            'incoterms.required' => __('messages.dashboard.freight.form.validations.incoterms_required'),
            'incoterms.max' => __('messages.dashboard.freight.form.validations.incoterms_max'),
        ];
    }

    /**
     * Define success messages for CRUD operations.
     */
    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.freight.form.success.create',
            'update' => 'messages.dashboard.freight.form.success.update',
            'delete' => 'messages.dashboard.freight.form.success.delete',
        ];
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    /**
     * Define error messages for CRUD operations.
     */
    public static function getErrorMessage($action)
    {
        $messages = [
            'not_found' => 'messages.dashboard.freight.form.error.not_found',
            'validation_failed' => 'messages.dashboard.freight.form.error.validation_failed',
        ];
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    /**
     * Define helper messages for freight operations.
     */
    public static function getHelperMessages()
    {
        return [
            'delete_header' => __('messages.dashboard.freight.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.freight.form.modal.delete_content'),
        ];
    }

    /**
     * Filter fields for the freight model.
     */
    public static function filterFields(): array
    {
        return [
            [
                'label' => 'messages.dashboard.freight.dropdown.origin',
                'value' => 'origin',
            ],
            [
                'label' => 'messages.dashboard.freight.dropdown.volume',
                'value' => 'volume',
            ],
            [
                'label' => 'messages.dashboard.freight.dropdown.weight',
                'value' => 'weight',
            ],
        ];
    }

    /**
     * Serialize the freight model to JSON.
     */
    public function serialize(): string
    {
        return json_encode([
            'name' => $this->name,
            'description' => $this->description,
            'origin' => $this->origin,
            'dimensions_units' => $this->dimensions_units,
            'dimensions' => $this->dimensions,
            'weight_units' => $this->weight_units,
            'weight' => $this->weight,
            'volume_units' => $this->volume_units,
            'volume' => $this->volume,
            'packages' => $this->packages,
            'incoterms' => $this->incoterms,
        ]);
    }

    /**
     * Deserialize JSON into a freight instance.
     */
    public static function deserialize(string $json): Freight
    {
        $data = json_decode($json, true);
        return new self([
            'name' => $data['name'],
            'description' => $data['description'],
            'origin' => $data['origin'],
            'dimensions_units' => $data['dimensions_units'],
            'dimensions' => $data['dimensions'],
            'weight_units' => $data['weight_units'],
            'weight' => $data['weight'],
            'volume_units' => $data['volume_units'],
            'volume' => $data['volume'],
            'packages' => $data['packages'],
            'incoterms' => $data['incoterms'],
        ]);
    }

    /**
     * Define routes for freight CRUD operations.
     */
    public static function getRoutes()
    {
        return [
            'store' => 'freight.store',
            'update' => 'freight.update',
            'destroy' => 'freight.destroy'
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id'); // Each freight belongs to one order
    }

}
