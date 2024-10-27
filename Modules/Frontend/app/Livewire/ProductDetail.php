<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\CuratorMedia;
use App\Models\Product;
use App\Models\ReviewProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class ProductDetail extends AbstractFrontendClass
{
    use WithPagination;
    protected static $middleware = ['auth', 'role:member|admin|super_admin'];

    public $product;
    public $thumbnail;
    public $productGalleries;
    // public $ulasans;
    public function mount()
    {
        $this->product =  Product::where('id', request()->get('id'))->first();

        $thumbnail = CuratorMedia::where('id', $this->product->thumbnail)->first();
        $galleries = [];
        foreach ($this->product->product_galleries as $gallery) {
            $res = CuratorMedia::where('id', $gallery)->first();
            $galleries[] = $res->url;
        }


        $this->thumbnail = $thumbnail;
        $this->productGalleries = $galleries;
    }
    public function render()
    {
        return view("frontend::pages.product-detail", [
            'product' => Product::where('id', request()->get('id'))->first(),
            'ulasans' => ReviewProduct::where('product_id', request()->get('id'))->paginate(30),
        ]);
    }

    public function addToCart()
    {
        $product = Product::with('gambarThumbnail')->where('id', $this->product->id)->first();
        $cartItem = Cart::add(
            Auth::user()->getAuthIdentifier(),
            $this->product->name,
            1,
            $this->product->price,
            $this->product->weight,
            [
                'discount' => $this->product->discount,
                'product_id' => $this->product->id,
                'products' => [
                    'thumbnail' => $product->gambarThumbnail->path ?? null,
                ],
            ]
        );

        $cartItem->associate(Product::getModel());
        Cart::search(function ($cartItem) {
            if (Cart::get($cartItem->rowId)) {
                $this->dispatch('updateCart');
                $this->dispatch('alert', ['type' => 'success', 'message' => 'Berhasil Menambahkan ke keranjang!']);
            } else {
                $this->dispatch('updateCart');
                $this->dispatch('alert', ['type' => 'success', 'message' => 'Berhasil Menambahkan ke keranjang!']);
                Cart::store(Auth::user()->getAuthIdentifier());
            }
        });
    }


    public function buyNow()
    {
        $product = Product::with('gambarThumbnail')->where('id', $this->product->id)->first();
        $cartItem = Cart::add(
            Auth::user()->getAuthIdentifier(),
            $this->product->name,
            1,
            $this->product->price,
            $this->product->weight,
            [
                'discount' => $this->product->discount,
                'product_id' => $this->product->id,
                'products' => [
                    'thumbnail' => $product->gambarThumbnail->path ?? null,
                ],
            ]
        );

        $cartItem->associate(Product::getModel());
        Cart::search(function ($cartItem) {
            if (Cart::get($cartItem->rowId)) {
                $this->dispatch('updateCart');
                $this->dispatch('alert', ['type' => 'success', 'message' => 'Berhasil Menambahkan ke keranjang!']);
                $this->redirect(route('frontend.keranjang', [
                    'cart_id' => Auth::user()->id
                ]));
            } else {
                $this->dispatch('updateCart');
                $this->dispatch('alert', ['type' => 'success', 'message' => 'Berhasil Menambahkan ke keranjang!']);
                $this->redirect(route('frontend.keranjang', [
                    'cart_id' => Auth::user()->id
                ]));
                Cart::store(Auth::user()->getAuthIdentifier());
            }
        });
    }

    public function setThumbnail($file)
    {
        $this->dispatch('previewImage', $file);
    }
}
