<?php

namespace Modules\Admin\Helpers\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

use function Modules\Frontend\Helpers\module_path;

class GenerateLivewireComponent extends Command
{

    protected $signature = 'make:livecomp-admin {name}';
    protected $description = 'Create a new Livewire Component';
    public function handle()
    {

        $filename = $this->argument('name');
        $toKebabCase = preg_replace('/(?<!^)[A-Z](?=[a-z])/', '-$0', $filename);
        $path  = module_path('Admin') . "\\app\\Livewire\\{$toKebabCase}.php";
        $camelCase = ucfirst($filename);
        $low = strtolower($filename);
        $content = <<<PHP
        <?php 
        namespace Modules\Admin\App\Livewire;
        use Modules\Admin\Helpers\AbstractAdminClass;

        class {$this->argument('name')} extends AbstractAdminClass
        {
            protected static array|string \$middleware = ['web'];
            protected static string \$navigationIcon = 'heroicon-o-rectangle-stack';
            protected static string \$navigationLabel = '$camelCase';
            protected static bool \$headerAction = false;
            protected static ?string \$heading = '$filename';

            public function render()
            {
                return view('admin::pages.{$low}');
            }

            public function pages():array{
                return [
                'index => {$camelCase}::class',
                ];
            }
        }
        PHP;

        if (File::exists($path)) {
            $this->error("{$this->argument('name')} already exists");
        } else {
            File::put($path, $content);
            $lowerFile = strtolower($filename);
            $pathView = module_path('Admin') . "\\resources\\views\\pages\\{$lowerFile}.blade.php";
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
