<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;
use App\Models\WebSupplier;

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
        // Get the current page from the request, default to 1
        $page = Request::query('page_suppliers', 1);

        // Paginate suppliers with a limit of 6 items per page
        $this->suppliers = WebSupplier::paginate(6, ['*'], 'page', $page);

        // Append the custom query parameter for pagination links
        $this->suppliers->appends(['page_suppliers' => $page]);

        // Decode details for each supplier
        $this->suppliers->getCollection()->transform(function ($supplier) {
            $supplier->details = json_decode($supplier->details, true);
            return $supplier;
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
