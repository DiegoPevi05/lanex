<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\WebService;
use App\Models\WebProduct;

class WebSupplierForm extends Component
{

    public $formRequest;
    public $supplier;
    public $services;
    public $products;
    /**
     * Create a new component instance.
     */
    public function __construct($formRequest = null, $supplier = null)
    {
        $this->formRequest = $formRequest;

        if ($supplier) {
            $supplier->details = json_decode($supplier->details, true);
            $this->supplier = $supplier;
        }else {
            $this->supplier = null; // or initialize with a default value
        }

        $this->services = WebService::select('id', 'name')->get();
        $this->products = WebProduct::select('id', 'name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.web-supplier-form', [
            'formRequest' => $this->formRequest,
            'supplier' => $this->supplier,
            'services' => $this->services,
            'products' => $this->products
        ]);
    }
}
