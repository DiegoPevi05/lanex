<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WrapperScroll extends Component
{
    public $id;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($id,$title)
    {
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.wrapper-scroll');
    }
}
