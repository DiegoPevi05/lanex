<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Brands extends Component
{
    public $title;
    public $variant;
    public $suppliers;
    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $variant = '', $suppliers = [])
    {
        $this->title = $title;
        $this->variant = $variant;
        $this->suppliers = $suppliers;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.brands');
    }
}
