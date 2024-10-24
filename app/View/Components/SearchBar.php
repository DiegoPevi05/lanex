<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBar extends Component
{
    public $id;
    public $currentDropDownOption;
    public $placeholderInput;
    public $dropDownId;
    public $dropDownOptions;
    public $labelButton;

    /**
     * Create a new component instance.
     */
    public function __construct($id='', $currentDropDownOption="", $placeholderInput="", $labelButton="", $dropDownId="" ,$dropDownOptions=[])
    {
        $this->id = $id;
        $this->currentDropDownOption = $currentDropDownOption;
        $this->placeholderInput = $placeholderInput;
        $this->dropDownId = $dropDownId;
        $this->dropDownOptions = $dropDownOptions;
        $this->labelButton = $labelButton;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.search-bar');
    }
}
