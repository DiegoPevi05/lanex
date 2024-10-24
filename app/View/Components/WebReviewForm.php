<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WebReviewForm extends Component
{
    public $formRequest;
    public $review;
    /**
     * Create a new component instance.
     */
    public function __construct($formRequest = null, $review = null)
    {
        $this->formRequest = $formRequest;
        $this->review = $review;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.web-review-form', [
            'formRequest' => $this->formRequest,
            'review' => $this->review
        ]);
    }
}
