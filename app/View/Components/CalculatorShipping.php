<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CalculatorShipping extends Component
{
    public $countries;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->countries = [];
        $countriesPath = storage_path('app/public/data/countries.json');
        if (file_exists($countriesPath)) {
            $this->countries = json_decode(file_get_contents($countriesPath), true);
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.calculator-shipping',[
            'countries' => $this->countries
        ]);
    }
}
