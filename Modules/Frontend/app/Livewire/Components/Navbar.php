<?php

namespace Modules\Frontend\App\Livewire\Components;

use App\Models\Cart;
use App\Models\Category;
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
            $this->carts = Cart::with('product')->where('user_id', Auth::user()->id)->with('user')->get();
            $this->cartCount = $this->carts->pluck('quantity')->sum();
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
        $this->cartCount = $this->carts->pluck('quantity')->sum();
    }

    public function removeItemFromCart($cartId, $productId)
    {
        $cart = Cart::find($cartId);
        $cart->delete();
        $this->dispatch('updateCart');
        $this->dispatch('alert', ['type' => 'success', 'message' => 'Berhasil menghapus item dari keranjang!']);
    }

    public function globalSearch() {}
}
