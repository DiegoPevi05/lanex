<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StepTracker extends Component
{
    public $steps;
    public $type;
    public $step;
    /**
     * Create a new component instance.
     */
    public function __construct(string $type,int $step)
    {
        // Predefined steps for flight and ship
        $flightSteps = [
            ['icon' => 'lucide-warehouse', 'label' => 'Warehouse', 'active' => false],
            ['icon' => 'mdi-airplane-landing', 'label' => 'Landing', 'active' => false],
            ['icon' => 'mdi-airplane-takeoff', 'label' => 'Takeoff', 'active' => false],
            ['icon' => 'heroicon-o-truck', 'label' => 'Transport', 'active' => false],
            ['icon' => 'lucide-package-check', 'label' => 'Delivery', 'active' => false],
        ];

        $shipSteps = [
            ['icon' => 'lucide-warehouse', 'label' => 'Docking', 'active' => false],
            ['icon' => 'mdi-ferry', 'label' => 'On Board', 'active' => false],
            ['icon' => 'lucide-anchor', 'label' => 'Anchoring', 'active' => false],
            ['icon' => 'heroicon-o-truck', 'label' => 'Transport', 'active' => false],
            ['icon' => 'lucide-package-check', 'label' => 'Delivery', 'active' => false],
        ];

        // Select the appropriate step array based on type
        $this->steps = $type === 'ship' ? $shipSteps : $flightSteps;
        $this->type = $type;
        $this->step = $step;

        // Update the active status based on the step parameter
        $this->setActiveSteps($step);
    }

    /**
     * Set the active status for the first `n` steps.
     */
    private function setActiveSteps(int $step)
    {
        for ($i = 0; $i < $step && $i < count($this->steps); $i++) {
            $this->steps[$i]['active'] = true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.step-tracker');
    }
}
