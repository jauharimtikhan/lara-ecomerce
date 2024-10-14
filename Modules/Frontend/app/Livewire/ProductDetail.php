<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ReviewProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class ProductDetail extends AbstractFrontendClass
{
    use WithPagination;
    protected static $middleware = ['auth', 'role:member|admin'];

    public $product;
    // public $ulasans;
    public function mount()
    {
        $this->product = Product::find(request()->get('id'));
    }
    public function render()
    {
        return view("frontend::pages.product-detail", [
            'product' => Product::find(request()->get('id')),
            'ulasans' => ReviewProduct::where('product_id', request()->get('id'))->paginate(30),
        ]);
    }

    public function addToCart()
    {
        try {

            Cart::create([
                'product_id' => $this->product->id,
                'user_id' => Auth::user()->id,
                'quantity' => 1,
                'sub_total' => $this->product->sum('price'),
                'grand_total' => $this->product->sum('price'),
                'weight' => $this->product->weight,

            ]);
            $this->dispatch('cartAdded');
            $this->callAlert('success', 'Berhasil Menambahkan ke Keranjang!');
        } catch (\Exception $th) {
            $this->callAlert('danger', 'Gagal Menambahkan ke Keranjang!');
        }
    }


    public function buyNow()
    {
        Cart::create([
            'product_id' => $this->product->id,
            'user_id' => Auth::user()->id,
            'quantity' => 1,
            'sub_total' => $this->product->sum('price'),
            'grand_total' => $this->product->sum('price'),

        ]);

        $this->redirect(route('frontend.keranjang', [
            'cart_id' => Auth::user()->id
        ]));
    }
}
