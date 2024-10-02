<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentSection extends Component
{
    public $header;
    public $title;
    public $svgContent;
    public $introduction;
    public $content1;
    public $content2;
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $header,
        string $title,
        string $svgContent,
        string $introduction,
        string $content1,
        string $content2 = null)
    {
        $this->header = $header;
        $this->title = $title; 
        $this->svgContent = $svgContent;
        $this->introduction = $introduction; 
        $this->content1 = $content1; 
        $this->content2 = $content2; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-section');
    }
}
