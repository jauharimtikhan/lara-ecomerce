<?php

use App\Http\Controllers\TesController;
// use App\Models\Cart;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Livewire\Logout;


use function Modules\Frontend\Helpers\module_path;



Route::get('/update/geologi_indonesia', [TesController::class, 'index'])->middleware('web');

Route::get('/', \Modules\Frontend\App\Livewire\Home::class)->name('home');
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

Route::get('/erase/cart', function () {
    try {
        Cart::destroy();
        Cart::instance('default')->erase(Auth::user()->getAuthIdentifier());
        // dd($cart);
        // dd(event('cart.erased'));
        return response()->json([
            'message' => 'success',
        ], 200);
    } catch (\Exception $th) {
        return response()->json([
            'message' => $th->getMessage(),
        ], 500);
    }
});
