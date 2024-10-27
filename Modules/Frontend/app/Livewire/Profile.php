<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class Profile extends AbstractFrontendClass
{
    protected static string|array $middleware = ['auth', 'role:super_admin|admin|member'];
    public ?array $dataUser = [
        'role' => null,
        'name' => null,
        'address' => null,
        'phone' => null,
        'profile' => null,
        'email' => null,
        'historyPayment' => null
    ];


    public function mount()
    {
        $cacheKey = "_" . config('app.key');
        $ttl = 60;
        $user = Cache::remember("profile{$cacheKey}", $ttl, function () {
            return UserDetail::with('user')->where('user_id', Auth::user()->id)->first();
        });

        $lastorder = Cache::remember("lastOrder{$cacheKey}", $ttl, function () {
            return Transaction::where('user_id', Auth::user()->id)->get();
        });
        $this->dataUser = [
            'role' => ucfirst(str_replace('_', ' ', Auth::user()->roles->first->name->name)),
            'name' => Auth::user()->name,
            'address' => $user?->alamat_lengkap,
            'phone' => $user?->notelp,
            'email' => Auth::user()->email,
            'profile' => 'heroicon-s-user-circle',
            'historyPayment' => collect($lastorder)

        ];
    }

    public function render()
    {
        return view('frontend::pages.profile');
    }
}
