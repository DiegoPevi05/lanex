<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public function __construct()
    {
        $this->user = Auth::user(); // Get the authenticated user
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar', [
            'user' => $this->user, // Pass the user to the view
        ]);
    }
}
