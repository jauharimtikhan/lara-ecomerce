<?php

namespace Modules\Frontend\App\Providers;

use Livewire\Livewire;

use function Modules\Frontend\Helpers\module_path;
use Illuminate\Support\Facades\Blade;
use Modules\Frontend\Helpers\Commands\GenerateLivewireComponent;

class FrontendServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected string $name = 'Frontend';
    protected string $nameLower = 'frontend';
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->registerView();
        $this->createLivewireComponent();
        $this->createLivewireSubComponent();
        $this->createBladeComponent();
        $this->commands(GenerateLivewireComponent::class);
    }

    private function registerView()
    {
        return $this->loadViewsFrom(module_path($this->name) . '/resources/views', 'frontend');
    }

    private function createLivewireComponent()
    {
        $components = glob(module_path($this->name) . '/app/Livewire/*');
        foreach ($components as $component) {

            $file = basename($component, '.php');
            $class = "Modules\\{$this->name}\\App\\Livewire\\{$file}";

            $files = strtolower($file);
            Livewire::component("frontend-component::{$files}", $class);
        }
    }

    private function createLivewireSubComponent()
    {
        $components = glob(module_path($this->name) . '/app/Livewire/Components/*');
        foreach ($components as $component) {

            $file = basename($component, '.php');
            $class = "Modules\\{$this->name}\\App\\Livewire\\Components\\{$file}";

            $files = strtolower($file);
            Livewire::component("frontend-sub-component::{$files}", $class);
        }
    }

    private function createBladeComponent()
    {
        $components = glob(module_path($this->name) . '/app/View/Components/*');
        foreach ($components as $component) {

            $file = basename($component, '.php');
            $class = "Modules\\{$this->name}\\App\\View\\Components\\{$file}";
            $files = strtolower($file);
            Blade::component($class, "frontend-component::{$files}");
        }
    }
}
