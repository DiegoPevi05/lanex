<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderCard extends Component
{

    public $order;
    public $type;
    /**
     * Create a new component instance.
     */
    public function __construct($data, $type = "default")
    {
        $this->order = $data;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order-card');
    }
}
