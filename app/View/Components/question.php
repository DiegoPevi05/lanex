<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class question extends Component
{

    public $id;
    public $question;
    public $answer;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $question, $answer)
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.question');
    }
}
