<?php

namespace App\Http\Controllers\Web;

use App\Models\Service;
use App\Services\FormService;

class ServiceController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Service(), $formService);
    }
}