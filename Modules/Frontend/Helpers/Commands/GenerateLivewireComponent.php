<?php

namespace Modules\Frontend\Helpers\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

use function Modules\Frontend\Helpers\module_path;

class GenerateLivewireComponent extends Command{

    protected $signature = 'make:livecomp {name}';
    protected $description = 'Create a new Livewire Component';
    public function handle(){

        $filename = $this->argument('name');
        $toKebabCase = preg_replace('/(?<!^)[A-Z](?=[a-z])/', '-$0', $filename);
        $path  = module_path('Frontend')."\\app\\Livewire\\{$toKebabCase}.php";

        $content = <<<PHP
        <?php 
        namespace Modules\Frontend\App\Livewire;
        use Modules\Frontend\Helpers\AbstractFrontendClass;

        class {$this->argument('name')} extends AbstractFrontendClass
        {
            public function render()
            {
                return view('');
            }
        }
        PHP;

        if(File::exists($path)){
            $this->error("{$this->argument('name')} already exists");
        }else{
            File::put($path, $content);
            $lowerFile = strtolower($filename);
            $pathView = module_path('Frontend')."\\resources\\views\\pages\\{$lowerFile}.blade.php";
            $contentView = <<<HTML
                <div>
                    <h1>Component {$this->argument('name')}</h1>
                </div>
            HTML;

            File::put($pathView, $contentView);
            $this->info("Component {$this->argument('name')} created successfully");
        }


    }
}