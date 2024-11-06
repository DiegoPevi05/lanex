<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientForm extends Component
{

    public $formRequest;
    public $client;
    /**
     * Create a new component instance.
     */
    public function __construct($formRequest = null, $client = null)
    {
        $this->formRequest = $formRequest;
        $this->client = $client;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client-form',[
            'formRequest' => $this->formRequest,
            'client' => $this->client
        ]);
    }
}
