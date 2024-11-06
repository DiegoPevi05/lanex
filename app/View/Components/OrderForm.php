<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderForm extends Component
{

    public $formRequest;
    public $order;

    /**
     * Create a new component instance.
     */

    public function __construct($formRequest = null, $order = null)
    {
        $this->formRequest = $formRequest;
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order-form',[
            'formRequest' => $this->formRequest,
            'order' => $this->order
        ]);
    }
}
