<?php

declare(strict_types=1);

namespace App\View\Components\Utilities;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

final class SwitchUser extends Component
{
    /**
     * @var User[]|Collection
     */
    public $users;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->users = User::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utilities.switch-user');
    }
}
