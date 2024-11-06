<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransportTypeForm extends Component
{

    public $formRequest;
    public $transport_type;
    public $icons;
    /**
     * Create a new component instance.
     */
    public function __construct($formRequest = null, $transport_type = null, $icons = [])
    {
        $this->formRequest = $formRequest;
        $this->icons = $icons;
        $this->transport_type = $transport_type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transport-type-form',[
            'formRequest' => $this->formRequest,
            'icons' => $this->icons,
            'transport_type' => $this->transport_type
        ]);
    }
}
