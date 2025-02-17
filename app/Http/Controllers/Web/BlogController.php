<?php

namespace App\Http\Controllers\Web;

use App\Models\WebBlog;
use App\Services\FormService;

class BlogController extends AbstractEntityController
{
    public function __construct(FormService $formService)
    {
        parent::__construct(new WebBlog(), $formService);
    }
}
