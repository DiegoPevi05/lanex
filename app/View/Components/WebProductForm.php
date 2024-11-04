<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\WebSupplier;

class WebProductForm extends Component
{
    public $formRequest;
    public $product;
    public $suppliers;
    /**
     * Create a new component instance.
     */
    public function __construct($formRequest = null, $product = null)
    {
        $this->formRequest = $formRequest;
        $this->product = $product;
        $this->suppliers = WebSupplier::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.web-product-form', [
            'formRequest' => $this->formRequest,
            'product' => $this->product,
            'suppliers' => $this->suppliers
        ]);
    }
}
