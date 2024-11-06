<?php

namespace App\Services;
use App\View\Components\WebReviewForm;
use App\View\Components\WebServiceForm;
use App\View\Components\WebProductForm;
use App\View\Components\WebSupplierForm;
use App\View\Components\TransportTypeForm;
use App\Services\IconService;

class FormService
{

    public function getFormComponent($formRequest,$typeEntity, $entity)
    {
        $formComponent = null;

        if($typeEntity == "review"){
            // Create the form component instance
            $formComponent = new WebReviewForm($formRequest, $entity);

        }elseif($typeEntity == "service"){

            $icons = IconService::getAllSvgIcons();
            // Create the form component instance
            $formComponent = new WebServiceForm($formRequest, $entity, $icons);

        }elseif($typeEntity == "product"){
            // Create the form component instance
            $formComponent = new WebProductForm($formRequest, $entity);

        }elseif($typeEntity == "supplier"){
            // Create the form component instance
            $formComponent = new WebSupplierForm($formRequest, $entity);

        }elseif($typeEntity == "transport_type"){

            $icons = IconService::getAllSvgIcons();

            $formComponent = new TransportTypeForm($formRequest, $entity, $icons);
        }

        return $formComponent;
    }
}
