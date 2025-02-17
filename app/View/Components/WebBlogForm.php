<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WebBlogForm extends Component
{
    public $formRequest;
    public $blog;
    
    public function __construct($formRequest = null, $blog = null)
    {
        $this->formRequest = $formRequest;
        $this->blog = $blog;
    }

    public function render(): View|Closure|string
    {
        return view('components.web-blog-form', [
            'formRequest' => $this->formRequest,
            'blog' => $this->blog
        ]);
    }
}