<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class Product extends AbstractFrontendClass
{
    use WithPagination;
    // public $products;
    public $perPage = 30;
    public string $searchQuery = '';
    public string $subSearchQuery = '';

    protected $listeners = [
        'loadMore'
    ];

    public function mount()
    {
        $this->initializeSearchQueries();
        $this->getProducts();
    }

    private function initializeSearchQueries(): void
    {
        $this->searchQuery = urldecode(request()->get('category', ''));
        $this->subSearchQuery = urldecode(request()->get('subcategory', ''));
    }

    public function placehlder(): string
    {
        return <<<HTML
        <div role="status" class="animate-pulse">
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 max-w-[640px] mb-2.5 mx-auto"></div>
            <div class="h-2.5 mx-auto bg-gray-300 rounded-full dark:bg-gray-700 max-w-[540px]"></div>
            <div class="flex items-center justify-center mt-4">
                <svg class="w-8 h-8 text-gray-200 dark:text-gray-700 me-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                </svg>
                <div class="w-20 h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 me-3"></div>
                <div class="w-24 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
            </div>
            <span class="sr-only">Loading...</span>
        </div>
        HTML;
    }

    public function loadMore(): void
    {
        $this->perPage += 1;
    }

    #[Computed]
    public function getProducts()
    {
        return ModelsProduct::with(['category', 'subcategory', 'gambarThumbnail'])
            ->where('is_active', 1)
            ->where(function ($query) {
                $query->when($this->searchQuery, function ($query) {
                    $query->whereHas('category', function ($q) {
                        $q->where('name', 'like', '%' . $this->searchQuery . '%');
                    });
                })->when($this->subSearchQuery, function ($query) {
                    $query->orWhereHas('category.subcategory', function ($q) {
                        $q->where('name', 'like', '%' . $this->subSearchQuery . '%');
                    });
                });
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('frontend::pages.product-list', [
            'products' => $this->getProducts(),
        ]);
    }
}
