<?php

namespace App\Livewire;

use Livewire\Component;

class ButtonLink extends Component
{
    public $url;
    public $leftIcon;
    public $rightIcon;
    public $text;
    public $variant;
    public $extraClasses;
    public $size;

    public function mount($url, $text = '', $leftIcon = null, $rightIcon = null , $variant = 'primary', $extraClasses = '', $size='md')
    {
        $this->url = $url;
        $this->leftIcon = $leftIcon;
        $this->rightIcon = $rightIcon;
        $this->text = $text;
        $this->variant = $variant;
        $this->extraClasses = $extraClasses;
        $this->size = $size;
    }

    public function render()
    {
        return view('livewire.button-link');
    }
}
