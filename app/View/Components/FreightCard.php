<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FreightCard extends Component
{
    public $freight;
    /**
     * Create a new component instance.
     */
    public function __construct($freight)
    {
        $this->freight = $freight;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.freight-card');
    }
}
