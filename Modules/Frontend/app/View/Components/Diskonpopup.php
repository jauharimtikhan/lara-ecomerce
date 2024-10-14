<?php

namespace Modules\Frontend\App\Livewire;

use Illuminate\View\Component as ViewComponent;

class Diskonpopup extends ViewComponent
{
    protected static string|array $middleware = 'auth';

    public function render()
    {
        return view('frontend::pages.diskon-pop-up');
    }
}
