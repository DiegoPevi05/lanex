<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServicesSection extends Component
{
    public $services;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->services = [
            [
                'route' => '/services/ship',
                'header' => 'Envio Maritimo',
                'content' => 'Reliable and efficient trucking services to meet your needs.',
                'svgIcon' => 'heroicon-o-truck',
            ],
            [
                'route' => '/services/air',
                'header' => 'Envio Aeroe',
                'content' => 'Fast and secure air cargo deliveries worldwide.',
                'svgIcon' => 'heroicon-o-truck',
            ],
            [
                'route' => '/services/air',
                'header' => 'Envio Aeroe',
                'content' => 'Fast and secure air cargo deliveries worldwide.',
                'svgIcon' => 'heroicon-o-truck',
            ],
            [
                'route' => '/services/air',
                'header' => 'Envio Aeroe',
                'content' => 'Fast and secure air cargo deliveries worldwide.',
                'svgIcon' => 'heroicon-o-truck',
            ],
            [
                'route' => '/services/air',
                'header' => 'Envio Aeroe',
                'content' => 'Fast and secure air cargo deliveries worldwide.',
                'svgIcon' => 'heroicon-o-truck',
            ],
            [
                'route' => '/services/air',
                'header' => 'Envio Aeroe',
                'content' => 'Fast and secure air cargo deliveries worldwide.',
                'svgIcon' => 'heroicon-o-truck',
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.services-section');
    }
}
