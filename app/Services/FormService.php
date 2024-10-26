<?php

namespace App\Services;
use App\View\Components\WebReviewForm;
use App\View\Components\WebServiceForm;

class FormService
{

    public function getFormComponent($formRequest,$typeEntity, $entity)
    {
        $formComponent = null;

        if($typeEntity == "review"){
            // Create the form component instance
            $formComponent = new WebReviewForm($formRequest, $entity);

        }elseif($typeEntity == "service"){

            // Create the form component instance
            $formComponent = new WebServiceForm($formRequest, $entity);

        }

        return $formComponent;
    }
}
