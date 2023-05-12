<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class InputPassword extends Component
{
    public string $name;

    public string $label;

    public bool $is_required = false;

    public string|int $value;

    public $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label, string|int $value = '', bool $is_required = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->is_required = $is_required;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-password');
    }
}
