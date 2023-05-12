<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Input extends Component
{
    public string $type;

    public string $name;

    public string $label;

    public string $placeholder;

    public bool $required;

    public $autofocus;

    public string|int $value;

    public function __construct(string $type, string $name, string $label, string $placeholder = '', bool $required = false, bool $autofocus = false, string|int $value = '')
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->autofocus = $autofocus;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
