<?php 
namespace Modules\Admin\App\View\Components;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;

class TextInput extends Component implements Htmlable{

    public function __construct(
        protected string $name

    ) {
//        
    }
    public function render(){
        return view("admin::components.text-input");
    }

    public function toHtml(){
        return $this->render()->render();
    }

    public static function make(
        string $name,
    ){
        return new self($name);
    }
}