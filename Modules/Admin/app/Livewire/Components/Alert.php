<?php

namespace Modules\Admin\App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public bool $show = false;
    public string $type = 'success';
    public string $icon;
    public string $message = '';

    #[On('admin-alert')]
    public function alert(array $params)
    {
        $this->show = true;
        $this->type = $params['type'];
        $this->message = $params['message'];
        $this->icon = match ($params['type']) {
            'success' => 'check',
            'danger' => 'ban',
            'warning' => 'exclamation',
        };
    }

    public function render()
    {
        return view('admin::components.alert');
    }
}
