<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Review extends Component
{
    public $stars;
    public $content;
    public $name;
    public $charge;
    public $variant;
    /**
     * Create a new component instance.
     */
    public function __construct(int $stars,string $content, string $name, string $charge, string $variant='')
    {
        $this->stars    = $stars;
        $this->content  = $content;
        $this->name     = $name;
        $this->charge   = $charge;
        $this->variant  = $variant;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.review');
    }
}
