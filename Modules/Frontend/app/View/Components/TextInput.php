<?php

namespace Modules\Frontend\App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    public function render(): View
    {
        return view('frontend::components.text-input');
    }
}
