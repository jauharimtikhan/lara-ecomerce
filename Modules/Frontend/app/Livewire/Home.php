<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Category;
use App\Models\HomeCms;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class Home extends AbstractFrontendClass
{
    use WithPagination;

    protected static string|array $middleware = ['role:super_admin|member|admin'];
    public $perPage = 12;
    protected $listeners = [
        'loadMore'
    ];

    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function render()
    {
        return view('frontend::pages.index', [
            'products' => Product::with('category')
                ->where('is_featured', 1)
                ->orderBy('id', 'desc')
                ->paginate($this->perPage),
            'categories' => Category::paginate(10),
            'dynamicContents' => HomeCms::find('9d600c3a-f0dc-4779-a22d-f897d3efde98'),
        ]);
    }
}
