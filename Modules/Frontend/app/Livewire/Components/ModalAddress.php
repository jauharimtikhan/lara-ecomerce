<?php

namespace Modules\Frontend\App\Livewire\Components;

use App\Models\UserDetail;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class ModalAddress extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->model(UserDetail::class)
            ->schema([])
            ->statePath('data');
    }

    public function render()
    {
        return view('frontend::components.modal-address');
    }
}
