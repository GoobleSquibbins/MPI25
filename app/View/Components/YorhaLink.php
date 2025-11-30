<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;

class YorhaLink extends Component
{
    public $route;
    public $label;

    public function __construct($route, $label)
    {
        $this->route = $route;
        $this->label = $label;
    }

    public function isActive()
    {
        return Request::routeIs($this->route);
    }

    public function render()
    {
        return view('components.yorha-link');
    }
}
