<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Web\AbstractEntityController;
use App\Models\TransportType;
use App\Services\FormService;

class TransportTypeController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new TransportType(), $formService);
    }
}
