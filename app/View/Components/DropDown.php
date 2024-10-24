<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropDown extends Component
{
    public $id;
    public $currentDropDownOption;
    public $options;
    /**
     * Create a new component instance.
     */
    public function __construct($id='',$currentDropDownOption = "",$options=[])
    {
        $this->id = $id;
        $this->currentDropDownOption = $currentDropDownOption;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {


        return view('components.drop-down');
    }
}
