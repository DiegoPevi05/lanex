<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Freight;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'status',
        'details',
        'net_amount',
        'taxes',
        'operative_cost',
        'numero_dam',
        'manifest',
        'channel',
        'client_id',
        'canceled',
        'client_name'
    ];

     public static function getType(): string
    {
        return 'order';
    }

    public static function getFillableFields($validatedFields, Request $request, Order $entity = null)
    {
        return [
            'order_number' => $entity && $entity->order_number
            ? $entity->order_number
            : (isset($validatedFields['order_number']) ? $validatedFields['order_number'] : self::generateOrderNumber()),

            'status' => $validatedFields['status'] ?? 'PENDING',
            'details' => $validatedFields['details'] ?? null,
            'net_amount' => $validatedFields['net_amount'] ?? 0,
            'taxes' => $validatedFields['taxes'] ?? 0,
            'operative_cost' => $validatedFields['operative_cost'] ?? 0,
            'numero_dam' => $validatedFields['numero_dam'] ?? 0,
            'manifest' => $validatedFields['manifest'] ?? 0,
            'channel' => $validatedFields['channel'] ?? 0,
            'client_id' => $validatedFields['client_id'] ?? null,
            'client_name' => $validatedFields['client_name'] ?? null,
        ];
    }

    /**
     * Generate a new order ID.
     */
    protected static function generateOrderNumber()
    {
        // Combine date, time, and a random number for a short unique ID
        return 'LNX' . date('ymd') . strtoupper(bin2hex(random_bytes(2)));
    }

    public static function getRoutes()
    {
        return [
            'store' => 'order.store',
            'update' => 'order.update',
            'destroy' => 'order.destroy',
            'cancel' => 'order.cancel'
        ];
    }

    // Define redirect routes
    public static function getRedirectRoutes($route = "index")
    {
        return match ($route) {
            'index' => 'dashboard.content',
            'store', 'update' => 'dashboard_order',
            default => 'dashboard_order',
        };
    }

    public static function getValidationRules($isUpdate = false)
    {
        $orderRules = [
            'order_number' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|string|max:255|in:PENDING,IN TRANSIT,COMPLETED',
            'details' => 'required|string',
            'net_amount' => 'required|numeric|min:0',
            'taxes' => 'sometimes|numeric|min:0',
            'operative_cost' => 'sometimes|numeric|min:0',
            'numero_dam' => 'sometimes|integer',
            'manifest' => 'sometimes|integer',
            'channel' => 'sometimes|integer',
            'client_id' => 'required|exists:clients,id',
            'client_name' => 'required|string'
        ];

        // Combine Order and Freight Validation Rules
        return array_merge($orderRules, Freight::getValidationRules($isUpdate),TransportType::getValidationRules($isUpdate));
    }

    public static function getValidationMessages()
    {
        $order_messages = [
            'order_number.required' => __('messages.dashboard.order.form.validations.order_number_required'),
            'order_number.string' => __('messages.dashboard.order.form.validations.order_number_string'),
            'order_number.max' => __('messages.dashboard.order.form.validations.order_number_max'),

            'status.required' => __('messages.dashboard.order.form.validations.status_required'),
            'status.string' => __('messages.dashboard.order.form.validations.status_string'),
            'status.max' => __('messages.dashboard.order.form.validations.status_max'),
            'status.in' => __('messages.dashboard.order.form.validations.status_in'),

            'details.required' => __('messages.dashboard.order.form.validations.details_required'),
            'details.string' => __('messages.dashboard.order.form.validations.details_string'),

            'net_amount.required' => __('messages.dashboard.order.form.validations.net_amount_required'),
            'net_amount.numeric' => __('messages.dashboard.order.form.validations.net_amount_numeric'),

            'taxes.required' => __('messages.dashboard.order.form.validations.taxes_required'),
            'taxes.numeric' => __('messages.dashboard.order.form.validations.taxes_numeric'),

            'operative_cost.required' => __('messages.dashboard.order.form.validations.operative_cost_required'),
            'operative_cost.numeric' => __('messages.dashboard.order.form.validations.operative_cost_numeric'),

            'numero_dam.required' => __('messages.dashboard.order.form.validations.numero_dam_required'),
            'numero_dam.integer' => __('messages.dashboard.order.form.validations.numero_dam_integer'),

            'manifest.required' => __('messages.dashboard.order.form.validations.manifest_required'),
            'manifest.integer' => __('messages.dashboard.order.form.validations.manifest_integer'),

            'channel.required' => __('messages.dashboard.order.form.validations.channel_required'),
            'channel.integer' => __('messages.dashboard.order.form.validations.channel_integer'),

            'client_id.required' => __('messages.dashboard.order.form.validations.client_id_required'),
            'client_id.exists' => __('messages.dashboard.order.form.validations.client_id_exists'),

            'client_name.required' => __('messages.dashboard.order.form.validations.client_name_required'),
            'client_name.string' => __('messages.dashboard.order.form.validations.client_name_string'),
        ];

        // Combine Order and Freight Validation Messages
        return array_merge($order_messages, Freight::getValidationRules(), TransportType::getValidationMessages());
    }

    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.order.form.success.create',
            'update' => 'messages.dashboard.order.form.success.update',
            'cancel' => 'messages.dashboard.order.form.success.cancel',
            'delete' => 'messages.dashboard.order.form.success.delete',
            'restore' => 'messages.dashboard.order.form.success.restore',
            'update_status' => 'messages.dashboard.order.form.success.update_status',
            'email_sended' => 'messages.dashboard.order.form.success.email_sended'

        ];
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    // Error messages
    public static function getErrorMessage($action)
    {
        $messages = [
            'not_found' => 'messages.dashboard.order.form.error.not_found',
            'validation_failed' => 'messages.dashboard.order.form.error.validation_failed',
        ];
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    // Helper messages
    public static function getHelperMessages()
    {
        return [
            'cancel_header' => __('messages.dashboard.order.form.modal.cancel_header'),
            'cancel_content' => __('messages.dashboard.order.form.modal.cancel_content'),
            'cancel_btn_label' => __('messages.dashboard.order.form.modal.cancel_btn_label'),
            'delete_header' => __('messages.dashboard.order.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.order.form.modal.delete_content'),
            'delete_btn_label' => __('messages.dashboard.order.form.modal.delete_btn_label'),
        ];
    }

    // Filter fields for dropdowns or filtering
    public static function filterFields(): array
    {
        return [
            ['label' => 'messages.dashboard.order.dropdown.order_number', 'value' => 'order_number'],
            ['label' => 'messages.dashboard.order.dropdown.status', 'value' => 'status'],
            ['label' => 'messages.dashboard.order.dropdown.client', 'value' => 'client_name'],
        ];
    }

    // Serialize the Order model into JSON
    public function serialize(): string
    {
        return json_encode([
            'order_number' => $this->order_number,
            'status' => $this->status,
            'details' => $this->details,
            'net_amount' => $this->net_amount,
            'taxes' => $this->taxes,
            'operative_cost' => $this->operative_cost,
            'numero_dam' => $this->numero_dam,
            'manifest' => $this->manifest,
            'channel' => $this->channel,
            'client_id' => $this->client_id,
        ]);
    }

    // Deserialize JSON into an Order object
    public static function deserialize(string $json): Order
    {
        $data = json_decode($json, true);
        return new self([
            'order_number' => $data['order_number'],
            'status' => $data['status'],
            'details' => $data['details'],
            'net_amount' => $data['net_amount'],
            'taxes' => $data['taxes'],
            'operative_cost' => $data['operative_cost'],
            'numero_dam' => $data['numero_dam'],
            'manifest' => $data['manifest'],
            'channel' => $data['channel'],
            'client_id' => $data['client_id'],
        ]);
    }



    public function freights()
    {
        return $this->hasMany(Freight::class, 'order_id'); // One-to-many relationship
    }

    public function trackingSteps()
    {
        return $this->hasMany(TrackingStep::class,'order_id'); // One-to-many relationship with tracking steps
    }

    public function getCurrentTrackStep()
    {
        // Step 1: Try to find the "IN TRANSIT" tracking step
        $inTransitStep = $this->trackingSteps->where('status', 'IN_TRANSIT')->first();

        // Step 2: If no "IN TRANSIT" step found, get the last "COMPLETED" step by highest sequence
        if (!$inTransitStep) {
            $inTransitStep = $this->trackingSteps
                ->where('status', 'COMPLETED')
                ->sortByDesc('sequence')
                ->first();
        }

        // Step 3: If no "COMPLETED" step found, get the first "PENDING" step by lowest sequence
        if (!$inTransitStep) {
            $inTransitStep = $this->trackingSteps
                ->where('status', 'PENDING')
                ->sortBy('sequence')
                ->first();
        }

        return $inTransitStep;
    }

    public function getNextTrackStep()
    {
        // Get the current step (this could be IN TRANSIT, COMPLETED, or PENDING)
        $currentStep = $this->getCurrentTrackStep();

        // If no current step found, return null or handle the case as needed
        if (!$currentStep) {
            return null;
        }

        // Get the next tracking step by finding the one with sequence + 1
        $nextStep = $this->trackingSteps()
            ->where('sequence', $currentStep->sequence + 1)
            ->first();

        // If no next step is found, return the current step (or handle it as per requirements)
        return $nextStep ?? $currentStep;
    }

    public function getFirstTrackStep()
    {
        // Get the first tracking step by the lowest sequence (earliest step)
        $firstStep = $this->trackingSteps()
            ->orderBy('sequence', 'asc') // Order by ascending sequence
            ->first();

        return $firstStep;
    }

    public function getLastTrackStep()
    {
        // Get the last tracking step by highest sequence (most recent step)
        $lastStep = $this->trackingSteps()
            ->orderByDesc('sequence')
            ->first();

        return $lastStep;
    }

    public function client()
    {
        return Client::where('id', $this->client_id)->first();
    }

}
