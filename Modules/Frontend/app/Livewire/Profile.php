<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class Profile extends AbstractFrontendClass
{
    protected static string|array $middleware = ['auth', 'rools:member|admin|super_admin'];

    public function render()
    {
        return view('frontend::pages.profile');
    }
}

