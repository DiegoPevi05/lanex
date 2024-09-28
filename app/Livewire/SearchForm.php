<?php

namespace App\Livewire;

use Livewire\Component;

class SearchForm extends Component
{
    public $activeTab = 'tab1'; // Default tab

    // Method to switch between tabs
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.search-form');
    }
}
