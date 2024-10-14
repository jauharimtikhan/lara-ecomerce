<?php

namespace Modules\Admin\Helpers;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("admin::layouts.app")]
abstract class AbstractAdminClass extends Component
{
  
    public function callAlert($type, $message)
    {
        $this->dispatch('admin-alert', ['type' => $type, 'message' => $message]);
    }

    public function redirectWithAction($action)
    {
        $this->redirect($action);
        return $this;
    }
}
