<?php
namespace Modules\Frontend\App\Livewire\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class CekOngkir extends Component
{

    public $modalId;
    public ?array $data = [];




    public function render()
    {
        return view('frontend::components.cek-ongkir');
    }
}