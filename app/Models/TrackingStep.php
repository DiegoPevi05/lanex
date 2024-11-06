<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingStep extends Model
{
    use HasFactory;

    protected $table = 'tracking_steps';

    protected $fillable = [
        'status',
        'sequence',
        'country',
        'city',
        'address',
        'order_id',
        'transport_type_id',
    ];

    public static function getType(): string
    {
        return 'tracking_step';
    }

    public static function getFillableFields($validatedFields, Request $request, TrackingStep $entity = null)
    {
        return [
            'status' => $validatedFields['status'] ?? 'PENDING',
            'sequence' => $validatedFields['sequence'] ?? null,
            'country' => $validatedFields['country'] ?? null,
            'city' => $validatedFields['city'] ?? null,
            'address' => $validatedFields['address'] ?? null,
            'order_id' => $validatedFields['order_id'] ?? null,
            'transport_type_id' => $validatedFields['transport_type_id'] ?? null,
        ];
    }

    public static function getRoutes()
    {
        return [
            'store' => 'tracking_step.store',
            'update' => 'tracking_step.update',
            'destroy' => 'tracking_step.destroy'
        ];
    }


    public static function getRedirectRoutes($route = "index")
    {
        if ($route == "index") {
            return "dashboard.content";
        } elseif ($route == "store" || $route == "update") {
            return "dashboard_tracking_step";
        }

        return "dashboard_tracking_step";
    }

    public static function getValidationRules($isUpdate = false)
    {
        return [
            'status' => [ $isUpdate ? 'sometimes|required' : 'required', 'string', 'max:255', 'in:PENDING,IN TRANSIT,COMPLETED'],
            'sequence' => 'required|integer|min:1',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'order_id' => 'required|exists:orders,id',
            'transport_type_id' => 'required|exists:transport_types,id',
        ];
    }

    public static function getValidationMessages()
    {
        return [
            'status.required' => __('messages.dashboard.tracking_step.form.validations.status_required'),
            'status.string' => __('messages.dashboard.tracking_step.form.validations.status_string'),
            'status.max' => __('messages.dashboard.tracking_step.form.validations.status_max'),
            'status.in' => __('messages.dashboard.tracking_step.form.validations.status_in'),

            'sequence.required' => __('messages.dashboard.tracking_step.form.validations.sequence_required'),
            'sequence.integer' => __('messages.dashboard.tracking_step.form.validations.sequence_integer'),
            'sequence.min' => __('messages.dashboard.tracking_step.form.validations.sequence_min'),

            'country.string' => __('messages.dashboard.tracking_step.form.validations.country_string'),
            'country.max' => __('messages.dashboard.tracking_step.form.validations.country_max'),

            'city.string' => __('messages.dashboard.tracking_step.form.validations.city_string'),
            'city.max' => __('messages.dashboard.tracking_step.form.validations.city_max'),

            'address.string' => __('messages.dashboard.tracking_step.form.validations.address_string'),
            'address.max' => __('messages.dashboard.tracking_step.form.validations.address_max'),

            'order_id.required' => __('messages.dashboard.tracking_step.form.validations.order_id_required'),
            'order_id.exists' => __('messages.dashboard.tracking_step.form.validations.order_id_exists'),

            'transport_type_id.required' => __('messages.dashboard.tracking_step.form.validations.transport_type_id_required'),
            'transport_type_id.exists' => __('messages.dashboard.tracking_step.form.validations.transport_type_id_exists'),
        ];
    }

    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.tracking_step.form.success.create',
            'update' => 'messages.dashboard.tracking_step.form.success.update',
            'delete' => 'messages.dashboard.tracking_step.form.success.delete',
        ];
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    public static function getErrorMessage($action)
    {
        $messages = [
            'not_found' => 'messages.dashboard.tracking_step.form.error.not_found',
            'validation_failed' => 'messages.dashboard.tracking_step.form.error.validation_failed',
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    public static function filterFields(): array
    {
        return [
            [
                'label' => 'messages.dashboard.tracking_step.dropdown.status',
                'value' => 'status',
            ],
            [
                'label' => 'messages.dashboard.tracking_step.dropdown.country',
                'value' => 'origin',
            ],
            [
                'label' => 'messages.dashboard.tracking_step.dropdown.city',
                'value' => 'origin',
            ],
        ];
    }

    public function serialize(): string
    {
        return json_encode([
            'status' => $this->status,
            'sequence' => $this->sequence,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'order_id' => $this->order_id,
            'transport_type_id' => $this->transport_type_id,
        ]);
    }

    public static function deserialize(string $json): TrackingStep
    {
        $data = json_decode($json, true);
        return new self([
            'status' => $data['status'],
            'sequence' => $data['sequence'],
            'country' => $data['country'],
            'city' => $data['city'],
            'address' => $data['address'],
            'order_id' => $data['order_id'],
            'transport_type_id' => $data['transport_type_id'],
        ]);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id'); // Each tracking step belongs to one order
    }

    public function transportType()
    {
        return $this->belongsTo(TransportType::class, 'transport_type_id');
    }

}
