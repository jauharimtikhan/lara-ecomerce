<?php

namespace Modules\Frontend\App\Livewire\Components;

use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public array $items;
    public $carts;

    public $cartCount;

    public function mount()
    {

        if (Auth::check()) {

            $this->carts[] = [
                'content' => collect(Cart::content())->toArray(),
                'total' => Cart::total(0, '', ''),
                'quantity' => Cart::count(),
                'subtotal' => Cart::subtotal(0, '', ''),
            ];
            $this->cartCount = Cart::count();
        } else {
            $this->carts = collect([]);
        }
        $this->items[] = Category::with('subcategory')->get();
    }

    public function render()
    {

        return view('frontend::layouts.navbar', [
            'items' => $this->items,
            'cartCount' => $this->cartCount
        ]);
    }
    #[On('updateCart')]
    public function updateCartCount()
    {
        $this->cartCount = Cart::count();
    }

    public function removeItemFromCart($cartId, $productId)
    {
        try {
            Cart::remove($productId);
            $this->dispatch('updateCart');
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Berhasil menghapus item dari keranjang!']);
        } catch (\Exception $th) {
            Cart::remove($productId);
            $this->dispatch('updateCart');
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Gagal menghapus item dari keranjang!']);
        }
    }

    public function globalSearch() {}
}
