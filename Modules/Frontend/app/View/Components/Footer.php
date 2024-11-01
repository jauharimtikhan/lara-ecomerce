<?php

namespace Modules\Frontend\App\View\Components;

use App\Models\HomeCms;
use Illuminate\View\Component;

class Footer extends Component
{
    public function render()
    {
        return view('frontend::layouts.footer', [
            'footer' => HomeCms::find('9d600c3a-f0dc-4779-a22d-f897d3efde98')
        ]);
    }
}
