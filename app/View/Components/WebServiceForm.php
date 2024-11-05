<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;
use App\Models\WebSupplier;

class WebServiceForm extends Component
{
    public $formRequest;
    public $service;
    public $icons;
    public $suppliers;
    /**
     * Create a new component instance.
     */
    public function __construct($formRequest = null, $service = null, $icons = [])
    {
        $this->formRequest = $formRequest;
        $this->icons = $icons;
        $this->suppliers = WebSupplier::select('id', 'name')->get();

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
            'service' => $this->service,
            'icons' => $this->icons,
            'suppliers' => $this->suppliers
        ]);
    }
}
