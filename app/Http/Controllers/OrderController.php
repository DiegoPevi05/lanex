<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Web\AbstractEntityController;
use App\Models\Order;
use App\Services\FormService;

class OrderController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Order(), $formService);
    }
}
