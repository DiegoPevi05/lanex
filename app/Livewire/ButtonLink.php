<?php

namespace App\Livewire;

use Livewire\Component;

class ButtonLink extends Component
{
    public $url;
    public $leftIcon;
    public $rightIcon;
    public $text;

    public function mount($url, $text = '', $leftIcon = null, $rightIcon = null)
    {
        $this->url = $url;
        $this->leftIcon = $leftIcon;
        $this->rightIcon = $rightIcon;
        $this->text = $text;
    }

    public function render()
    {
        return view('livewire.button-link');
    }
}
