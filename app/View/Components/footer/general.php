<?php

declare(strict_types=1);

namespace App\View\Components\footer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class general extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer.general');
    }
}
