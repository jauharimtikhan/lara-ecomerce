<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class Home extends AbstractFrontendClass
{
    protected static string|array $middleware = 'auth';

    public function render()
    {
        return view('frontend::pages.index', [
            'products' => Product::with('category')->paginate(1),
            'categories' => Category::paginate(10)
        ]);
    }
}
