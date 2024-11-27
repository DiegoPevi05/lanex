<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{

    public $url;
    public $leftIcon;
    public $rightIcon;
    public $text;
    public $variant;
    public $extraClasses;
    public $size;
    public $arialabel;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($url, $text = '', $leftIcon = null, $rightIcon = null , $variant = 'primary', $extraClasses = '', $size='md', $arialabel = 'messages.aria_labels.default', $title  = 'messages.titles.default')
    {
        $this->url = $url;
        $this->leftIcon = $leftIcon;
        $this->rightIcon = $rightIcon;
        $this->text = $text;
        $this->variant = $variant;
        $this->extraClasses = $extraClasses;
        $this->size = $size;
        $this->arialabel = $arialabel;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
