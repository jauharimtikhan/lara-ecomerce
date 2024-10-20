<?php

use App\Http\Controllers\TesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Livewire\Logout;
use Modules\Admin\App\Livewire\Resources\KategoriResource\CreateKategori;
use Modules\Frontend\App\Livewire\Home;

use function Modules\Frontend\Helpers\module_path;

Route::get('/update/geologi_indonesia', [TesController::class, 'index'])->middleware('web');

Route::get('/', Home::class)->name('home');
Route::prefix('membership')->group(function () {
    $components = glob(module_path('Frontend') . '/app/Livewire/*.php');
    foreach ($components as $component) {
        $file = basename($component, '.php');
        $class = "Modules\\Frontend\\App\\Livewire\\{$file}";
        $uri = strtolower($file);
        $reflection = new ReflectionClass($class);
        if ($reflection->hasProperty('middleware')) {
            if (is_array($reflection->getStaticPropertyValue('middleware'))) {
                $middleware = $reflection->getStaticPropertyValue('middleware');
            }

            if (is_string($reflection->getStaticPropertyValue('middleware'))) {
                $middleware = $reflection->getStaticPropertyValue('middleware');
            }
        }
        Route::get("/{$uri}", $class)->name("frontend.{$uri}")->middleware($middleware ?? null);
    }
    Route::get("/logout", function () {
        Auth::logout();
        return to_route('frontend.login');
    })->name('frontend.logout');
});

Route::prefix('admin')->group(function () {
    $components = glob(module_path('Admin') . '/app/Livewire/*.php');
    foreach ($components as $component) {
        $file = basename($component, '.php');
        $class = "Modules\\Admin\\App\\Livewire\\{$file}";
        $uri = strtolower($file);
        $reflection = new ReflectionClass($class);
        if ($reflection->hasProperty('middleware')) {
            if (is_array($reflection->getStaticPropertyValue('middleware'))) {
                $middleware = $reflection->getStaticPropertyValue('middleware');
            }

            if (is_string($reflection->getStaticPropertyValue('middleware'))) {
                $middleware = $reflection->getStaticPropertyValue('middleware');
            }
        }


        Route::get("/{$uri}", $class)->name("admin.{$uri}")->middleware($middleware ?? null);
    }

    $componentResources = glob(module_path('Admin') . '/app/Livewire/Resources/**/*.php');

    foreach ($componentResources as $resource) {
        $file = basename($resource, '.php');
        $directory = basename(dirname($resource));
        $class = "Modules\\Admin\\App\\Livewire\\Resources\\{$directory}\\{$file}";
        $uri = strtolower($file);
        $reflection = new ReflectionClass($class);
        if ($reflection->hasProperty('middleware')) {
            if (is_array($reflection->getStaticPropertyValue('middleware'))) {
                $middleware = $reflection->getStaticPropertyValue('middleware');
            }

            if (is_string($reflection->getStaticPropertyValue('middleware'))) {
                $middleware = $reflection->getStaticPropertyValue('middleware');
            }
        }
        $split = preg_split('/(create|edit)/', $uri, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        switch ($split[0]) {
            case 'edit':
                Route::get("/{$split[1]}/{$split[0]}/{id}", $class)->name("admin.{$uri}")->middleware($middleware ?? null);
                break;
            default:
                Route::get("/{$split[1]}/{$split[0]}", $class)->name("admin.{$uri}")->middleware($middleware ?? null);
                break;
        }
    }
    Route::get("/logout", function () {
        Auth::logout();
        return to_route('admin.login');
    })->name('admin.logout');
});
