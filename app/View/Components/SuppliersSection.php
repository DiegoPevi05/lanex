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
    public $parentUrl;
    public $parentUrlId;
    /**
     * Create a new component instance.
     */
    public function __construct($header, $title, $parentUrl, $parentUrlId = null)
    {
        $this->header = $header;
        $this->title = $title;
        $this->parentUrl = $parentUrl;
        $this->parentUrlId = $parentUrlId;
        // Get the current page from the request, default to 1
        $page = Request::query('page_suppliers', 1);

        // Get the supplier_name filter from the request
        $supplierName = Request::query('supplier_name', null);

        // Base query for suppliers
        $query = WebSupplier::query();

        // Apply case-insensitive name filter if supplier_name is present
        if ($supplierName) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($supplierName) . '%']);
        }

        // Paginate suppliers with a limit of 6 items per page
        $this->suppliers = $query->paginate(6, ['*'], 'page', $page);

        // Append the custom query parameters for pagination links
        $this->suppliers->appends([
            'page_suppliers' => $page,
            'supplier_name' => $supplierName,
        ]);

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
