<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class Supplier extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'details'
    ];

    public static function getFillableFields($validatedFields, Request $request, Supplier $entity = null)
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
            'logo' => $processImage('logo', $entity ? $entity->logo : null),
            'description' => $validatedFields['description'] ?? null,
            'details' => json_encode($validatedFields['details'] ?? []) ,
        ];

    }

    public static function getRoutes(){
        return [
            'store' => 'suppliers.store',
            'update' => 'suppliers.update',
            'destroy'=>'suppliers.destroy'
        ];
    }

    /**
     * Get Routes to redirect.
     */
     public static function getRedirectRoutes($route="index"){

         if($route == "index"){

            return "dashboard.web-content";

         }elseif($route == "store" || $route == "update"){

            return "dashboard_web_supplier";
         }


         return "dashboard_web_supplier";
    }

    /**
     * Get validation rules for creating or updating a review.
     */
    public static function getValidationRules($isUpdate = false)
    {
        return [
            'name' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => $isUpdate ? 'sometimes|required|string|max:400' : 'required|string|max:400',
            'details' => $isUpdate ? 'sometimes|array|min:1' : 'required|array|min:1',
            'details.*' => 'string|max:300',
        ];
    }

    public static function getValidationMessages()
    {
        return [
            'name.required' => __('messages.dashboard.web.supplier.form.validations.name_required'),
            'name.string' => __('messages.dashboard.web.supplier.form.validations.name_string'),
            'name.max' => __('messages.dashboard.web.supplier.form.validations.name_max'),

            'logo.image' => __('messages.dashboard.web.supplier.form.validations.logo_image'),
            'logo.mimes' => __('messages.dashboard.web.supplier.form.validations.logo_mimes'),
            'logo.max' => __('messages.dashboard.web.supplier.form.validations.logo_max'),

            'description.required' => __('messages.dashboard.web.supplier.form.validations.description_required'),
            'description.string' => __('messages.dashboard.web.supplier.form.validations.description_string'),
            'description.max' => __('messages.dashboard.web.supplier.form.validations.description_max'),

            'details.required' => __('messages.dashboard.web.supplier.form.validations.details_required'),
            'details.array' => __('messages.dashboard.web.supplier.form.validations.details_array'),
            'details.min' => __('messages.dashboard.web.supplier.form.validations.details_min'),
            'details.*.string' => __('messages.dashboard.web.supplier.form.validations.details_item_string'),
            'details.*.max' => __('messages.dashboard.web.supplier.form.validations.details_item_max'),

        ];
    }

    /**
     * Get success messages for CRUD operations.
     */
    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.web.supplier.form.success.create',
            'update' => 'messages.dashboard.web.supplier.form.success.update',
            'delete' => 'messages.dashboard.web.supplier.form.success.delete',
        ];
        // Return the translated message using __() helper
        return isset($messages[$action]) ? __($messages[$action]) : '';
    }


    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    /**
     * Get error messages for CRUD operations.
     */
    public static function getErrorMessage($action)
    {
        $messages = [
            'not_found' => 'messages.dashboard.web.supplier.form.error.not_found',
            'validation_failed' => 'messages.dashboard.web.supplier.form.error.validation_failed',
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    public static function getHelperMessages(){

        return [
            'delete_header' => __('messages.dashboard.web.supplier.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.web.supplier.form.modal.delete_content'),
        ];

    }

    public static function getType(): string
    {
        return 'supplier';
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
                'label' => 'messages.dashboard.web.supplier.dropdown.name',
                'value' => 'name',
            ],
            [
                'label' => 'messages.dashboard.web.supplier.dropdown.description',
                'value' => 'description',
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
            'logo' => $this->logo,
            'description' => $this->description,
            'details' => $this->details,
        ]);
    }

    /**
     * Deserialize a JSON string into a Review object.
     *
     * @param string $json
     * @return Review
     */
    public static function deserialize(string $json): Supplier
    {
        $data = json_decode($json, true);

        // Create a new Review instance with the deserialized data
        return new self([
            'name' => $data['name'],
            'logo' => $data['logo'],
            'description' => $data['description'],
            'details' => $data['details'],
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_supplier');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
