<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GenericInput extends Component {

    public $name;

    public $type;

    public $label;

    public $value;

    public $placeholder;

    public $required;

    public $readonly;

    public $id;

    public $items;

    public $isDropdown;

    public $isList;

    public $multiple;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $id = '',
        $value = '',
        $name = '',
        $type = 'text',
        $label = '',
        $placeholder = '',
        $required = FALSE,
        $readonly = FALSE,
        $items = [],
        $isDropdown = FALSE,
        $isList = FALSE,
        $multiple = FALSE
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->items = $items;
        $this->isDropdown = $isDropdown;
        $this->isList = $isList;
        $this->multiple = $multiple;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.generic-input');
    }

}
