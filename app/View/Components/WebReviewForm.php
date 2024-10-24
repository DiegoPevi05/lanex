<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WebReviewForm extends Component
{
    public $id;
    public $type_request;
    public $review;
    /**
     * Create a new component instance.
     */
    public function __construct($id = 'create_form', $type_request ='post', $review = null)
    {
        $this->id = $id;
        $this->type_request = $type_request;
        $this->review = $review;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.web-review-form');
    }
}
