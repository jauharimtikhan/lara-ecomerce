<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class PesananSaya extends AbstractFrontendClass
{
    protected static string|array $middleware = ['auth', 'role:member|admin|super_admin'];
    public $data;
    public $products;
    public function mount()
    {

        $this->data = Transaction::where('user_id', Auth::id())
            ->where('id', request('order_id'))
            ->firstOrFail();

        $this->products = collect($this->data->products)->map(function ($product) {
            return [
                'items' => Product::with('gambarThumbnail')->find($product['id']),
                'qty' => $product['quantity'],
                'price' => $product['price'],
            ];
        });
    }

    public function render()
    {
        return view('frontend::pages.pesanan-saya');
    }
}
