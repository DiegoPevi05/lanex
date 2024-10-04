<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Supplier;

class SuppliersSection extends Component
{
    public $suppliers;
    public $header;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($header, $title)
    {
        $this->header = $header;
        $this->title = $title;
        // Fetch all suppliers and ensure it's not null
        $this->suppliers = Supplier::limit(6)->get();

        // Decode details for each supplier
        $this->suppliers->each(function ($supplier) {
            $supplier->details = json_decode($supplier->details, true);
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.suppliers-section');
    }
}
