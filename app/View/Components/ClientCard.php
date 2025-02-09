<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientCard extends Component
{

    public $client;
    /**
     * Create a new component instance.
     */
    public function __construct($data)
    {
        $this->client = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client-card');
    }
}
