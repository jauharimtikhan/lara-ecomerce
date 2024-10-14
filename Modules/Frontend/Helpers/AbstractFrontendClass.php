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
        Notification::make('alert' . $this->__id)

                    ->title($message)->$type()->send();
    }
}
