<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Textarea extends Component
{
    public $name;

    public $label;

    public $placeholder;

    public $value;

    public $cols;

    public $rows;

    public $disabled;

    public $style;

    public function __construct($name, $label, $placeholder = null, $value = null, $cols = null, $rows = null, $disabled = false, $style = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->cols = $cols;
        $this->rows = $rows;
        $this->disabled = $disabled;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea');
    }
}
