<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class WebServiceForm extends Component
{
    public $formRequest;
    public $service;
    /**
     * Create a new component instance.
     */
    public function __construct($formRequest = null, $service = null)
    {
        $this->formRequest = $formRequest;

        if ($service) {
            $service->webcontent = json_decode($service->webcontent, true);
            $this->service = $service;
        }else {
            $this->service = null; // or initialize with a default value
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.web-service-form', [
            'formRequest' => $this->formRequest,
            'service' => $this->service
        ]);
    }
}
