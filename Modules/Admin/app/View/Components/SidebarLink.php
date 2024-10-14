<?php

namespace Modules\Admin\App\View\Components;

use Illuminate\View\Component;

class SidebarLink extends Component
{
    public array $items;
    public bool|string $is_active = false;
    public function __construct(
        $items,
        $property = false
    ) {
        $this->items = $items;
        $this->is_active = $property;
    }


    public function render()
    {
        return view("admin::components.sidebar-link", [
            "items" => $this->items,
            'is_active' => $this->is_active
        ]);
    }
}
