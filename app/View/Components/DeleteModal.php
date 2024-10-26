<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteModal extends Component
{
    public $id;
    public $deleteRoute;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $deleteRoute)
    {
        $this->id = $id;
        $this->deleteRoute = $deleteRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-modal');
    }
}
