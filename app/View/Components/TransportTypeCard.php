<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransportTypeCard extends Component
{
    public $transport_type;
    /**
     * Create a new component instance.
     */
    public function __construct($data)
    {
        $this->transport_type = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transport-type-card');
    }
}
