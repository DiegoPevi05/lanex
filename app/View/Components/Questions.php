<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Questions extends Component
{
    public $questions;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Sample questions and answers
        $this->questions = [
            [
                'id' => 1,
                'question' => 'What is the return policy?',
                'answer' => 'You can return any item within 30 days of purchase.',
            ],
            [
                'id' => 2,
                'question' => 'How do I track my order?',
                'answer' => 'You will receive a tracking number via email once your order has shipped.',
            ],
            [
                'id' => 3,
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes, we ship to many countries worldwide. Check our shipping page for details.',
            ],
            [
                'id' => 4,
                'question' => 'How can I contact customer support?',
                'answer' => 'You can reach customer support via the contact form on our website or by calling our hotline.',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.questions');
    }
}
