<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Str;

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
        if ($data instanceof Review) {
            $review = $data;
            $this->id = (string)$review->id;  // Convert ID to string
            $this->type = $review->getType();  // Call on the instance
            $this->preview = Str::limit($review->review, 100, '...');  // Limit preview to 50 characters
            $this->updated = $review->updated_at->format('Y-m-d');  // Format the date
            $this->deleteRoute = $review->getRoutes()['destroy'];
            $this->deleteMessages = $review->getHelperMessages();

        }elseif($data instanceof Service){

            $service = $data;
            $this->id = (string)$service->id;  // Convert ID to string
            $this->type = $service->getType();  // Call on the instance
            $this->preview = Str::limit($service->short_description, 100, '...');  // Limit preview to 50 characters
            $this->updated = $service->updated_at->format('Y-m-d');  // Format the date
            $this->deleteRoute = $service->getRoutes()['destroy'];
            $this->deleteMessages = $service->getHelperMessages();

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