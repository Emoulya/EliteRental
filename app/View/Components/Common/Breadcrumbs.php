<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;
use Illuminate\View\View;

class Breadcrumbs extends Component
{
    /**
     * Array of breadcrumb links. Each link should be an associative array
     * with 'url', 'label', and optionally 'icon' and 'active' boolean.
     *
     * @var array
     */
    public array $links;

    /**
     * Create a new component instance.
     */
    public function __construct(array $links)
    {
        $this->links = $links;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.common.breadcrumbs');
    }
}
