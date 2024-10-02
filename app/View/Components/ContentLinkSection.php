<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentLinkSection extends Component
{
    public $header;
    public $title;
    public $svgContent;
    public $content;
    public $button;
    public $href;
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $header,
        string $title,
        string $svgContent,
        string $content,
        string $button,
        string $href = '#')
    {
        $this->header = $header;
        $this->title = $title; 
        $this->svgContent = $svgContent;
        $this->content = $content; 
        $this->button = $button; 
        $this->href = $href; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-link-section');
    }
}
