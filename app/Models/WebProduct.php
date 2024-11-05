<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class WebProduct extends Model
{

    use HasFactory;

    protected $table = 'web_products';

    protected $fillable = [
        'name',
        'image',
        'stars',
        'description',
        'EAN'
    ];

    public static function getFillableFields($validatedFields, Request $request, WebProduct $entity = null)
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

        // Process the fillable fields
        $fillableFields = [
            'name' => $validatedFields['name'] ?? null,
            'image' => $processImage('image', $entity ? $entity->image : null),
            'stars' => $validatedFields['stars'] ?? null,
            'description' => $validatedFields['description'] ?? null,
            'EAN' => $validatedFields['EAN'] ?? null,
        ];

        // Sync suppliers if the suppliers field is provided in the request
        if ($entity && $request->has('suppliers')) {
            $supplierIds = $request->input('suppliers', []);
            $entity->suppliers()->sync($supplierIds);
        }

        return $fillableFields;

    }

    public static function getRoutes(){
        return [
            'store' => 'products.store',
            'update' => 'products.update',
            'destroy'=>'products.destroy'
        ];
    }

    /**
     * Get Routes to redirect.
     */
     public static function getRedirectRoutes($route="index"){

         if($route == "index"){

            return "dashboard.web-content";

         }elseif($route == "store" || $route == "update"){

            return "dashboard_web_product";
         }


         return "dashboard_web_product";
    }

    /**
     * Get validation rules for creating or updating a review.
     */
    public static function getValidationRules($isUpdate = false)
    {
        return [
            'name' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'stars' => $isUpdate ? 'sometimes|required|integer|min:1|max:5' : 'required|integer|min:1|max:5',
            'description' => $isUpdate ? 'sometimes|required|string|max:600' : 'required|string|max:600',
            'EAN' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
        ];
    }

    public static function getValidationMessages()
    {
        return [
            'name.required' => __('messages.dashboard.web.product.form.validations.name_required'),
            'name.string' => __('messages.dashboard.web.product.form.validations.name_string'),
            'name.max' => __('messages.dashboard.web.product.form.validations.name_max'),

            'image.image' => __('messages.dashboard.web.product.form.validations.image_image'),
            'image.mimes' => __('messages.dashboard.web.product.form.validations.image_mimes'),
            'image.max' => __('messages.dashboard.web.product.form.validations.image_max'),

            'stars.required' => __('messages.dashboard.web.product.form.validations.stars_required'),
            'stars.integer' => __('messages.dashboard.web.product.form.validations.stars_integer'),
            'stars.min' => __('messages.dashboard.web.product.form.validations.stars_min'),
            'stars.max' => __('messages.dashboard.web.product.form.validations.stars_max'),

            'description.required' => __('messages.dashboard.web.product.form.validations.description_required'),
            'description.string' => __('messages.dashboard.web.product.form.validations.description_string'),
            'description.max' => __('messages.dashboard.web.product.form.validations.description_max'),

            'EAN.required' => __('messages.dashboard.web.product.form.validations.ean_required'),
            'EAN.string' => __('messages.dashboard.web.product.form.validations.ean_string'),
            'EAN.max' => __('messages.dashboard.web.product.form.validations.ean_max'),
        ];
    }

    /**
     * Get success messages for CRUD operations.
     */
    public static function getSuccessMessage($action)
    {
        $messages = [
            'create' => 'messages.dashboard.web.product.form.success.create',
            'update' => 'messages.dashboard.web.product.form.success.update',
            'delete' => 'messages.dashboard.web.product.form.success.delete',
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
            'not_found' => 'messages.dashboard.web.product.form.error.not_found',
            'validation_failed' => 'messages.dashboard.web.product.form.error.validation_failed',
        ];

        return isset($messages[$action]) ? __($messages[$action]) : '';
    }

    public static function getHelperMessages(){

        return [
            'delete_header' => __('messages.dashboard.web.product.form.modal.delete_header'),
            'delete_content' => __('messages.dashboard.web.product.form.modal.delete_content'),
        ];

    }

    public static function getType(): string
    {
        return 'product';
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
                'label' => 'messages.dashboard.web.product.dropdown.name',
                'value' => 'name',
            ],
            [
                'label' => 'messages.dashboard.web.product.dropdown.description',
                'value' => 'description',
            ],
            [
                'label' => 'messages.dashboard.web.product.dropdown.stars',
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
            'stars' => $this->stars,
            'description' => $this->description,
            'image' => $this->image,
            'EAN' => $this->EAN,
        ]);
    }

    /**
     * Deserialize a JSON string into a Review object.
     *
     * @param string $json
     * @return Review
     */
    public static function deserialize(string $json): WebProduct
    {
        $data = json_decode($json, true);

        // Create a new Review instance with the deserialized data
        return new self([
            'name' => $data['name'],
            'image' => $data['image'],
            'stars' => $data['stars'],
            'description' => $data['description'],
            'EAN' => $data['EAN'],
        ]);
    }

    public function suppliers()
    {
        return $this->belongsToMany(WebSupplier::class, 'web_product_supplier','product_id', 'supplier_id');
    }
}
