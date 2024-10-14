<?php
namespace Modules\Frontend\App\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Modules\Frontend\Helpers\AbstractFrontendClass;
class Product extends AbstractFrontendClass
{
    use WithPagination;
    public $products = [];
    public $currentPage = 1;
    public $hasMorePages = true;
    public string $searchQuery = '';
    public string $subSearchQuery = '';

    public function mount()
    {
        $query = request()->get('category');
        $subQuery = request()->get('subcategory');
        $this->searchQuery = urldecode($query);
        $this->subSearchQuery = urldecode($subQuery);
        $this->loadProducts();
    }

    public function placehlder()
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

    public function loadProducts()
    {
        $newProducts = $this->getProducts($this->searchQuery, $this->subSearchQuery);

        if (count($newProducts) > 0) {
            $this->products = array_merge($this->products, $newProducts);
            $this->currentPage++;
        } else {
            $this->hasMorePages = false; // Tidak ada halaman lebih
        }
    }
    #[On('loadMore')]
    public function loadMore()
    {
        if ($this->hasMorePages) {
            $this->loadProducts();
        }
    }

    protected function getProducts($searchQuery = null, $subSearchQuery = null)
    {
        $products = ModelsProduct::with(['category', 'category.subcategory'])
            ->where('is_active', '=', 1)
            ->where(function ($query) use ($searchQuery, $subSearchQuery) {
                // Kondisi untuk kategori dan subkategori harus terpenuhi
                $query->where(function ($categoryQuery) use ($searchQuery) {
                    $categoryQuery->whereHas('category', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . $searchQuery . '%');
                    });
                })
                    ->where(function ($subcategoryQuery) use ($subSearchQuery) {
                    $subcategoryQuery->whereHas('category.subcategory', function ($query) use ($subSearchQuery) {
                        $query->where('name', 'like', '%' . $subSearchQuery . '%');
                    });
                });
            })
            ->paginate(12, ['*'], 'page', $this->currentPage);
        return [
            'data' => $products->items(),
            'current_page' => $products->currentPage(),
            'has_more_pages' => $products->hasMorePages(),
        ];
    }


    public function render()
    {
        return view('frontend::pages.product-list', [
            'products' => $this->products,
        ]);
    }

   
}