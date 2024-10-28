<?php

namespace App\Http\Controllers\Web;

use App\Models\Supplier;
use App\Services\FormService;

class SupplierController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Supplier(), $formService);
    }
}
