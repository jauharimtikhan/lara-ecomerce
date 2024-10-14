<?php 

namespace Modules\Frontend\App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component{
    public $show = false;
    public $type;
    public $message;

    public $icon;
    #[On('alert')]
    public function alert(array $params){
        $this->show = true;
        $this->type = match($params['type']){
            'success' => 'green',
            'error'=> 'red',
            'warning' => 'yellow',
            'info' => 'blue',
            default => 'blue',
        };
        $this->icon = match($params['type']){
            'success' => 'check',
            'error'=> 'ban',
            'warning' => 'exclamation',
            'info' => 'warning',
            default => 'check',
        };
        $this->message = $params['message'];
    }

    public function render(){
        return view('frontend::components.toast');
    }
}