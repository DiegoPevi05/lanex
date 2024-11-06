<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Web\AbstractEntityController;
use App\Models\Client;
use App\Services\FormService;

class ClientController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Client(), $formService);
    }
}
