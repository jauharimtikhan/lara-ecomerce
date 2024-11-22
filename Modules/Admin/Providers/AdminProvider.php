<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\Facades\Blade;

use function Modules\Frontend\Helpers\module_path;

class AdminProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        //
    }
    public function register()
    {
        $path = base_path() . "/Modules/Admin/views";
        $this->loadViewsFrom($path, 'admin');
        $this->createBladeComponent();
    }

    private function createBladeComponent()
    {
        $components = glob(module_path('admin') . '/Components/*');
        foreach ($components as $component) {

            $file = basename($component, '.php');
            $class = "Modules\\Admin\\Components\\{$file}";
            $files = strtolower($file);
            Blade::component($class, "admin-component::{$files}");
        }
    }
}
