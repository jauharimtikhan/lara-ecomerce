<?php

namespace Modules\Frontend\App\Livewire;

use Modules\Frontend\Helpers\AbstractFrontendClass;

class AboutMe extends AbstractFrontendClass
{
    protected static string|array $middleware = ['role:super_admin|member|admin'];

    public function render()
    {
        return view('frontend::pages.about-me');
    }
}
