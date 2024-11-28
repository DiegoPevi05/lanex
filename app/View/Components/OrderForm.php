<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\IconService;

class OrderForm extends Component
{

    public $formRequest;
    public $order;
    public $icons;

    /**
     * Create a new component instance.
     */

    public function __construct($formRequest = null, $order = null)
    {
        $this->formRequest = $formRequest;
        $this->order = $order;
        $this->icons = IconService::getAllSvgIcons();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order-form',[
            'formRequest' => $this->formRequest,
            'order' => $this->order,
            'icons' => $this->icons
        ]);
    }
}
