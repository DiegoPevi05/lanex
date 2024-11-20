<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'client_id',
        'company',
        'RUC',
        'cellphone',
        'email'
    ];

    /**
     * Get the type of the model.
     */
    public static function getType(): string
    {
        return 'client';
    }

    /**
     * Prepare fillable fields from validated data.
     */
    public static function getFillableFields($validatedFields, Request $request, Client $entity = null)
    {
        return [
            'client_id' => $entity && $entity->client_id
            ? $entity->client_id
            : (isset($validatedFields['client_id']) ? $validatedFields['client_id'] : self::generateClientId()),
            'company' => $validatedFields['company'] ?? null,
            'RUC' => $validatedFields['RUC'] ?? null,
            'cellphone' => $validatedFields['cellphone'] ?? null,
            'email' => $validatedFields['email'] ?? null,
        ];
    }

    /**
     * Generate a new client ID.
     */
    protected static function generateClientId()
    {
        // Combine date, time, and a random number for a short unique ID
        return 'client_' . date('ymd') . bin2hex(random_bytes(2));
    }

    /**
     * Define routes for client CRUD operations.
     */
    public static function getRoutes()
    {
        return [
            'store' => 'client.store',
            'update' => 'client.update',
            'destroy' => 'client.destroy'
        ];
    }

    /**
     * Define redirection routes after actions.
     */
    public static function getRedirectRoutes($route = "index")
    {
        if ($route === "index") {
            return "dashboard.content";
        } elseif ($route === "store" || $route === "update") {
            return "dashboard_client";
        }
        return "dashboard_client";
    }

    /**
     * Define validation rules for the client.
     */
    public static function getValidationRules($isUpdate = false)
    {
        return [
            'client_id' => $isUpdate ? 'sometimes|required|integer' : 'sometimes|integer',
            'company' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'RUC' => $isUpdate ? 'sometimes|required|string|max:13' : 'required|string|max:13',
            'cellphone' => $isUpdate ? 'sometimes|required|string|max:15' : 'required|string|max:15',
            'email' => $isUpdate ? 'sometimes|required|email|max:255' : 'required|email|max:255',
        ];
    }

    /**
     * Define custom validation messages.
     */
    public static function getValidationMessages()
    {
        return [
            'client_id.required' => __('messages.dashboard.client.form.validations.client_id_required'),
            'client_id.integer' => __('messages.dashboard.client.form.validations.client_id_integer'),

            'company.required' => __('messages.dashboard.client.form.validations.company_required'),
            'company.string' => __('messages.dashboard.client.form.validations.company_string'),
            'company.max' => __('messages.dashboard.client.form.validations.company_max'),

            'RUC.required' => __('messages.dashboard.client.form.validations.RUC_required'),
            'RUC.string' => __('messages.dashboard.client.form.validations.RUC_string'),
            'RUC.max' => __('messages.dashboard.client.form.validations.RUC_max'),

            'cellphone.required' => __('messages.dashboard.client.form.validations.cellphone_required'),
            'cellphone.string' => __('messages.dashboard.client.form.validations.cellphone_string'),
            'cellphone.max' => __('messages.dashboard.client.form.validations.cellphone_max'),

            'email.required' => __('messages.dashboard.client.form.validations.email_required'),
            'email.email' => __('messages.dashboard.client.form.validations.email_valid'),
            'email.max' => __('messages.dashboard.client.form.validations.email_max'),
        ];
    }

    /**
     * Define success messages for CRUD operations.
     */
    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.client.form.success.create',
            'update' => 'messages.dashboard.client.form.success.update',
            'delete' => 'messages.dashboard.client.form.success.delete',
        ];
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    /**
     * Define error messages for CRUD operations.
     */
    public static function getErrorMessage($action)
    {
        $messages = [
            'not_found' => 'messages.dashboard.client.form.error.not_found',
            'validation_failed' => 'messages.dashboard.client.form.error.validation_failed',
        ];
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    /**
     * Define helper messages for client operations.
     */
    public static function getHelperMessages()
    {
        return [
            'delete_header' => __('messages.dashboard.client.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.client.form.modal.delete_content'),
        ];
    }

    /**
     * Filter fields for the client model.
     */
    public static function filterFields(): array
    {
        return [
            [
                'label' => 'messages.dashboard.client.dropdown.company',
                'value' => 'company',
            ],
            [
                'label' => 'messages.dashboard.client.dropdown.RUC',
                'value' => 'RUC',
            ],
            [
                'label' => 'messages.dashboard.client.dropdown.cellphone',
                'value' => 'cellphone',
            ],
        ];
    }

    /**
     * Serialize the client model to JSON.
     */
    public function serialize(): string
    {
        return json_encode([
            'client_id' => $this->client_id,
            'company' => $this->company,
            'RUC' => $this->RUC,
            'cellphone' => $this->cellphone,
            'email' => $this->email,
        ]);
    }

    /**
     * Deserialize JSON into a client instance.
     */
    public static function deserialize(string $json): Client
    {
        $data = json_decode($json, true);
        return new self([
            'client_id' => $data['client_id'],
            'company' => $data['company'],
            'RUC' => $data['RUC'],
            'cellphone' => $data['cellphone'],
            'email' => $data['email'],
        ]);
    }
}
