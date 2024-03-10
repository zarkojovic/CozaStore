<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GenericTable extends Component {

    public $columns;

    public $items;

    public $routeBaseName;

    /**
     * Create a new component instance.
     */
    public function __construct($columns, $items, $routeBaseName) {
        $this->columns = $columns;
        $this->items = $items;
        $this->routeBaseName = $routeBaseName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.generic-table');
    }

}
