<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class WebContent extends Component
{
    use WithPagination;

    public $type;
    public $currentContent = null;

    public function mount($type = 'review') {
        $this->type = $type;
    }

    public function updateContent($type)
    {
        $this->type = $type;
        $this->currentContent = $this->loadContent($type);
    }

    public function loadContent($type) {
        // Logic to load the content based on the type
        return "Loaded content for $type"; // Replace this with actual content logic
    }

    public function render()
    {
        $pagination = Model::paginate(10); // Replace Model with your actual model
        return view('livewire.web-content', [
            'pagination' => $pagination,
            'currentContent' => $this->currentContent,
        ]);
    }
}
