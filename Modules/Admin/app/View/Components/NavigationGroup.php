<?php
namespace Modules\Admin\View\Components;

use Illuminate\View\Component;

class NavigationGroup extends Component{
    public function render(){
        return view('admin::components.navigation-group');
    }
}