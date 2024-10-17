<?php

namespace Modules\Frontend\Helpers;

use Filament\Notifications\Notification;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("frontend::layouts.app")]
abstract class AbstractFrontendClass extends Component
{

    public function callAlert($type, $message)
    {
        $this->dispatch('alert', ['type' => $type, 'message' => $message]);
    }
}
