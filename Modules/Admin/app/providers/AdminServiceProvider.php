<?php

namespace Modules\Admin\App\Providers;

require_once __DIR__ . '/../../Helpers/helpers.php';

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Admin\App\View\Components\HeadingSection;
use Modules\Admin\App\View\Components\SidebarLink;
use Modules\Admin\Helpers\Commands\GenerateLivewireComponent;
use Illuminate\Support\Str;
use Modules\Admin\View\Components\Button;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;

use function Modules\Frontend\Helpers\module_path;

class AdminServiceProvider extends ServiceProvider
{
    protected string $name = 'Admin';
    protected string $nameLower = 'admin';
    protected $metodQuickAction;


    public function boot()
    {
        $this->registerView();
        $this->createLivewireComponent();
        $this->createBladeComponent();
        $this->commands(GenerateLivewireComponent::class);
        $this->registerSidebarComponent();
        $this->registerHeaderSection();

        Livewire::component('admin-component::component.button', Button::class);
    }

    public function register()
    {
        // Uncomment the lines below as needed:
    }

    private function registerView()
    {
        $this->loadViewsFrom(module_path($this->name) . '/resources/views', 'admin');
    }

    private function createLivewireComponent()
    {
        $dir = module_path($this->name) . '/app/Livewire';
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $filePath = $file->getPathname();

                $fileName = basename($filePath, '.php');


                $relativePath = str_replace(module_path($this->name), '', $filePath);
                $relativePath = str_replace(['/app/', '.php'], ['/Modules/Admin/App/', ''], $relativePath);
                $namespace = str_replace('/', '\\', $relativePath);
                $namespace = trim($namespace, '\\');

                $fileNameLower = strtolower($fileName);

                if (class_exists($namespace)) {
                    Livewire::component("admin-component::{$fileNameLower}", $namespace);
                }
            }
        }
    }



    private function getComponentClass($component, $namespace)
    {
        $file = basename($component, '.php');
        return "Modules\\{$this->name}\\App\\{$namespace}\\{$file}";
    }

    private function createBladeComponent()
    {
        $components = glob(module_path($this->name) . '/app/View/Components/*.php');

        foreach ($components as $component) {
            $class = $this->getComponentClass($component, 'View\\Components');
            if (class_exists($class)) {
                Blade::component($class, "admin-component::" . strtolower(basename($component, '.php')));
            }
        }
    }

    private function registerSidebarComponent()
    {
        app()->bind(SidebarLink::class, function () {
            $routes = Route::getRoutes();
            $roles = [];

            foreach ($routes as $route) {
                $routeAction = $route->getAction();
                if ($this->isAdminRoute($routeAction)) {
                    if (
                        str_contains($routeAction['as'], 'admin.create') ||
                        str_contains($routeAction['as'], 'admin.edit') ||
                        str_contains($routeAction['as'], 'admin.login') ||
                        str_contains($routeAction['as'], 'admin.register') ||
                        str_contains($routeAction['as'], 'admin.hakakses') ||
                        str_contains($routeAction['as'], 'admin.logout') ||
                        str_contains($routeAction['as'], 'admin.subcategory')
                    ) {
                        continue;
                    }

                    $roles[] = $this->buildSidebarRole($route, $routeAction);
                }
            }

            return new SidebarLink($roles, false);
        });
    }

    private function buildSidebarRole($route, $routeAction)
    {
        $clearPrefix = str_replace("admin.", "", $routeAction['as']);
        $controller = $this->getController($routeAction);
        $reflectionClass = new ReflectionClass($controller);
        $instace = $reflectionClass->newInstance();
        $pagesMethodValue = $this->getPagesMethodValue($reflectionClass, $instace);
        $childrenActive = [];


        foreach ($pagesMethodValue as $key => $child) {
            $reflection = new ReflectionClass($child);
            $shortName = strtolower($reflection->getShortName());
            $childrenActive[$key] = [
                'name' => $shortName,
                'url' => "admin.{$shortName}",
                'label' => $reflection->getStaticPropertyValue('navigationLabel') ?? $reflection->getShortName(),
            ];
        }
        if ($reflectionClass->hasProperty('navigationGroup')) {
            return [
                'name' => $routeAction['as'],
                'url' => $route->uri(),
                'label' => $reflectionClass->getStaticPropertyValue('navigationLabel') ?? ucfirst($clearPrefix),
                'icon' => $reflectionClass->getStaticPropertyValue('navigationIcon') ?? 'heroicon-o-stack',
                'children' => $childrenActive,
                'group' => $reflectionClass->getStaticPropertyValue('navigationGroup'),
                'middleware' => $route->middleware(),
            ];
        } else {
            return [
                'name' => $routeAction['as'],
                'url' => $route->uri(),
                'label' => $reflectionClass->getStaticPropertyValue('navigationLabel') ?? ucfirst($clearPrefix),
                'icon' => $reflectionClass->getStaticPropertyValue('navigationIcon') ?? 'heroicon-o-stack',
                'children' => $childrenActive,
                'group' => null,
                'middleware' => $route->middleware(),
            ];

        }
    }



    private function getController($routeAction)
    {
        if (isset($routeAction['controller'])) {
            return str_contains($routeAction['controller'], '__invoke')
                ? $this->parseController($routeAction['controller'])
                : $routeAction['controller'];
        }

        return null;
    }

    private function parseController($controller)
    {
        $explode = explode('@', basename($controller))[0];
        $dir = dirname($controller);
        return "{$dir}\\{$explode}";
    }

    private function registerHeaderSection()
    {
        app()->bind(HeadingSection::class, function () {
            $breadcrumbs = [];
            $heading = '';

            foreach (Route::getRoutes() as $route) {
                $routeAction = $route->getAction();
                if ($this->isAdminRoute($routeAction) && Route::currentRouteName() == $routeAction['as']) {
                    $controller = $this->getController($routeAction);
                    $reflectionClass = new ReflectionClass($controller);
                    $instance = $reflectionClass->newInstance();

                    $pagesMethodValue = $this->getPagesMethodValue($reflectionClass, $instance);
                    $pages = [];
                    foreach ($pagesMethodValue as $key => $page) {
                        $pages[$key] = $page;
                    }
                    $breadcrumbs = array_merge($breadcrumbs, $this->generateBreadcrumbs($reflectionClass, $pages, $routeAction));

                    $heading .= $this->getHeading($reflectionClass);
                    if ($reflectionClass->hasMethod('quickAction')) {
                        $this->metodQuickAction = $instance->quickAction();
                    }
                }
            }

            return new HeadingSection($breadcrumbs, $heading, $reflectionClass->getStaticPropertyValue('headerAction') ?? false, $this->metodQuickAction ?? null);
        });
    }

    private function isAdminRoute($routeAction)
    {
        return isset($routeAction['as']) && str_contains($routeAction['as'], 'admin.');
    }

    private function getPagesMethodValue($reflectionClass, $instance)
    {
        return $reflectionClass->hasMethod('pages') ? $reflectionClass->getMethod('pages')->invoke($instance) : null;
    }

    private function generateBreadcrumbs($reflectionClass, $pagesMethodValue, $routeAction)
    {
        $breadcrumbs = [];
        $reflectionName = $reflectionClass->getShortName();
        $icon = $reflectionClass->getStaticPropertyValue('navigationIcon') ?? 'heroicon-s-home';

        if (is_string($pagesMethodValue)) {
            $breadcrumbs[] = $this->createBreadcrumbItem($reflectionName, $icon, $routeAction['as'], 'List');
        } elseif (is_array($pagesMethodValue)) {
            foreach ($pagesMethodValue as $key => $child) {

                $childReflection = new ReflectionClass($child);
                $breadcrumbs[] = $this->createBreadcrumbItem(
                    $reflectionName,
                    $icon,
                    $routeAction['as'],
                    $key == 'index' ? 'List' : $childReflection->getShortName(),
                    'admin.' . strtolower($childReflection->getShortName())
                );
            }
        }

        return $breadcrumbs;
    }

    private function createBreadcrumbItem($name, $icon, $route, $childName, $childRoute = null)
    {
        return [
            'name' => $name,
            'icon' => $icon,
            'route' => $route,
            'children' => [
                [
                    'name' => $childName,
                    'icon' => $icon,
                    'route' => $childRoute ?? $route,
                ]
            ]
        ];
    }

    private function getHeading($reflectionClass)
    {
        return $reflectionClass->getStaticPropertyValue('heading') ?? ucfirst($reflectionClass->getShortName());
    }
}
