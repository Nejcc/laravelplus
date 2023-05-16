<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Select extends Component
{
    public $name;

    public $label;

    public $options;

    public $value;

    public function __construct($name, $label, $options, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (!$this->value) {
            $this->options = ['' => 'Select here'] + $this->options;
        }

        return view('components.form.select');
    }
}
