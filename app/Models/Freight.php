<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Freight extends Model
{
    use HasFactory;

    protected $table = 'freights';

    protected $fillable = [
        'freight_id',
        'name',
        'description',
        'origin',
        'dimensions_units',
        'dimensions',
        'weight_units',
        'weight',
        'volume_units',
        'volume',
        'packages',
        'incoterms',
        'order_id'
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
            'freight_id' => $entity && $entity->freight_id
            ? $entity->freight_id
            : (isset($validatedFields['freight_id']) ? $validatedFields['freight_id'] : self::generateFreightId()),
            'name' => $validatedFields['name'] ?? null,
            'description' => $validatedFields['description'] ?? null,
            'origin' => $validatedFields['origin'] ?? null,
            'dimensions_units' => $validatedFields['dimensions_units'] ?? null,
            'dimensions' => $validatedFields['dimensions'] ?? 0,
            'weight_units' => $validatedFields['weight_units'] ?? null,
            'weight' => $validatedFields['weight'] ?? 0,
            'volume_units' => $validatedFields['volume_units'] ?? null,
            'volume' => $validatedFields['volume'] ?? 0,
            'packages' => $validatedFields['packages'] ?? null,
            'incoterms' => $validatedFields['incoterms'] ?? null,
        ];
    }

    /**
     * Generate a new order ID.
     */
    protected static function generateFreightId()
    {
        // Combine date, time, and a random number for a short unique ID
        return 'LNXFR' . date('ymd') . strtoupper(bin2hex(random_bytes(2)));
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
            'freight' => 'required|array|min:1',
            'freight.*.id' => 'sometimes|string|max:255',
            'freight.*.name' =>  'required|string|max:255',
            'freight.*.origin' =>  'required|string|max:255',
            'freight.*.description' => 'nullable|string|max:500',
            'freight.*.dimensions_units' => 'nullable|string|in:m,mm,cm,in',
            'freight.*.dimensions' => 'nullable|numeric|min:0',
            'freight.*.weight_units' => 'nullable|string|in:kg,lbs',
            'freight.*.weight' => 'nullable|numeric|min:0',
            'freight.*.volume_units' => 'nullable|string|in:m3,mm3,cm3,in3',
            'freight.*.volume' => 'nullable|numeric|min:0',
            'freight.*.packages' => 'required|integer|min:1',
            'freight.*.incoterms' => 'sometimes|string|max:255',
        ];
    }

    /**
     * Define custom validation messages.
     */
    public static function getValidationMessages()
    {
        return [
            'freight.required' => __('messages.dashboard.freight.form.validations.freight_required'),
            'freight.array' => __('messages.dashboard.freight.form.validations.freight_array'),
            'freight.min' => __('messages.dashboard.freight.form.validations.freight_min'),

            'freight.*.id.string' => __('messages.dashboard.freight.form.validations.id_string'),
            'freight.*.id.max' => __('messages.dashboard.freight.form.validations.id_max'),

            'freight.*.name.required' => __('messages.dashboard.freight.form.validations.name_required'),
            'freight.*.name.string' => __('messages.dashboard.freight.form.validations.name_string'),
            'freight.*.name.max' => __('messages.dashboard.freight.form.validations.name_max'),

            'freight.*.origin.required' => __('messages.dashboard.freight.form.validations.origin_required'),
            'freight.*.origin.string' => __('messages.dashboard.freight.form.validations.origin_string'),
            'freight.*.origin.max' => __('messages.dashboard.freight.form.validations.origin_max'),

            'freight.*.description.string' => __('messages.dashboard.freight.form.validations.description_string'),
            'freight.*.description.max' => __('messages.dashboard.freight.form.validations.description_max'),

            'freight.*.dimensions_units.in' => __('messages.dashboard.freight.form.validations.dimensions_units_in'),

            'freight.*.dimensions.numeric' => __('messages.dashboard.freight.form.validations.dimensions_numeric'),
            'freight.*.dimensions.min' => __('messages.dashboard.freight.form.validations.dimensions_min'),

            'freight.*.weight_units.in' => __('messages.dashboard.freight.form.validations.weigth_units_in'),

            'freight.*.weight.numeric' => __('messages.dashboard.freight.form.validations.weigth_numeric'),
            'freight.*.weight.min' => __('messages.dashboard.freight.form.validations.weigth_min'),

            'freight.*.volume_units.in' => __('messages.dashboard.freight.form.validations.volume_units_in'),

            'freight.*.volume.numeric' => __('messages.dashboard.freight.form.validations.volume_numeric'),
            'freight.*.volume.min' => __('messages.dashboard.freight.form.validations.volume_min'),

            'freight.*.packages.required' => __('messages.dashboard.freight.form.validations.packages_required'),
            'freight.*.packages.integer' => __('messages.dashboard.freight.form.validations.packages_integer'),
            'freight.*.packages.min' => __('messages.dashboard.freight.form.validations.packages_min'),

            'freight.*.incoterms.string' => __('messages.dashboard.freight.form.validations.incoterms_string'),
            'freight.*.incoterms.max' => __('messages.dashboard.freight.form.validations.incoterms_max'),
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
                'label' => 'messages.dashboard.freight.dropdown.freight_id',
                'value' => 'freight_id',
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
