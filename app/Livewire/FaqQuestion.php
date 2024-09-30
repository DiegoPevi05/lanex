<?php

namespace App\Livewire;

use Livewire\Component;

class FaqQuestion extends Component
{
    public $isOpen = false;
    public $id;
    public $question;
    public $answer;

    public function toggle()
    {
        $this->isOpen = !$this->isOpen; // Toggle the state
    }

    public function mount($id, $question, $answer)
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
    }

    public function render()
    {
        return view('livewire.faq-question');
    }
}
