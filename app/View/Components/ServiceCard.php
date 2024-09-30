<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceCard extends Component
{

    public $header;
    public $content;
    public $svgIcon;
    public $route;
    /**
     * Create a new component instance.
     */
    public function __construct(string $header,string $content,  string $svgIcon, string $route)
    {
        $this->header = $header;
        $this->content = $content;
        $this->svgIcon = $svgIcon;
        $this->route  = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-card');
    }
}
