<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\WebReview;
use App\Models\WebService;
use App\Models\WebProduct;
use App\Models\WebSupplier;
use Illuminate\Support\Str;
use App\Models\WebBlog;

class WebContentCard extends Component
{
    /**
     * Create a new component instance.
     */

    public $id;
    public $preview;
    public $type;
    public $updated;
    public $deleteRoute;
    public $deleteMessages;

    public function __construct($data)
    {
        if ($data instanceof WebReview) {
            $review = $data;
            $this->id = (string)$review->id;  // Convert ID to string
            $this->type = $review->getType();  // Call on the instance
            $this->preview = Str::limit($review->review, 100, '...');  // Limit preview to 50 characters
            $this->updated = $review->updated_at->format('Y-m-d');  // Format the date
            $this->deleteRoute = $review->getRoutes()['destroy'];
            $this->deleteMessages = $review->getHelperMessages();

        }elseif($data instanceof WebService){

            $service = $data;
            $this->id = (string)$service->id;  // Convert ID to string
            $this->type = $service->getType();  // Call on the instance
            $this->preview = Str::limit($service->short_description, 100, '...');  // Limit preview to 50 characters
            $this->updated = $service->updated_at->format('Y-m-d');  // Format the date
            $this->deleteRoute = $service->getRoutes()['destroy'];
            $this->deleteMessages = $service->getHelperMessages();

        }elseif($data instanceof WebProduct){

            $product = $data;
            $this->id = (string)$product->id;  // Convert ID to string
            $this->type = $product->getType();  // Call on the instance
            $this->preview = $product->name;  // Limit preview to 50 characters
            $this->updated = $product->updated_at->format('Y-m-d');  // Format the date
            $this->deleteRoute = $product->getRoutes()['destroy'];
            $this->deleteMessages = $product->getHelperMessages();

        }elseif($data instanceof WebSupplier){

            $supplier = $data;
            $this->id = (string)$supplier->id;  // Convert ID to string
            $this->type = $supplier->getType();  // Call on the instance
            $this->preview = $supplier->name;  // Limit preview to 50 characters
            $this->updated = $supplier->updated_at->format('Y-m-d');  // Format the date
            $this->deleteRoute = $supplier->getRoutes()['destroy'];
            $this->deleteMessages = $supplier->getHelperMessages();

        }else if($data instanceof WebBlog){

            $blog = $data;
            $this->id = (string)$blog->id;  // Convert ID to string
            $this->type = $blog->getType();  // Call on the instance
            $this->preview = $blog->title;  // Limit preview to 50 characters
            $this->updated = $blog->updated_at->format('Y-m-d');  // Format the date
            $this->deleteRoute = $blog->getRoutes()['destroy'];
            $this->deleteMessages = $blog->getHelperMessages();
        }
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.web-content-card');
    }
}
