<?php

namespace App\Http\Controllers\Web;

use App\Models\Review;
use App\Services\FormService;

class ReviewController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new Review(), $formService);
    }
}