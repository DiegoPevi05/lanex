<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceCard extends Component
{

    public $id;
    public $name;
    public $icon;
    public $description;
    /**
     * Create a new component instance.
     */
    public function __construct(string $id,string $name,  string $icon, string $description)
    {
        $this->id                   = $id;
        $this->name                 = $name;
        $this->icon                 = $icon;
        $this->description          = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-card');
    }
}
