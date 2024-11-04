<?php

namespace App\Http\Controllers\Web;

use App\Models\WebReview;
use App\Services\FormService;

class ReviewController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new WebReview(), $formService);
    }
}
