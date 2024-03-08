<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component {

    public $currentPage;

    public $breadcrumbsLinks = [];

    /**
     * Create a new component instance.
     */
    public function __construct($currentPage, $breadcrumbsLinks = []) {
        $this->currentPage = $currentPage;
        $this->breadcrumbsLinks = $breadcrumbsLinks;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.breadcrumb');
    }

}
