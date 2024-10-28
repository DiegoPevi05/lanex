<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Services\FormService;

class ProductController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Product(), $formService);
    }
}
