<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Orders;
use App\Models\Transaction;
use App\Models\UserDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class Payment extends AbstractFrontendClass
{
    protected static $middleware = ["auth", "role:member|admin|super_admin"];

    public $items;

    public function mount()
    {
        try {
            $this->items = Transaction::with('user')
                ->where('user_id', Auth::user()->id)
                ->where('status', 'pending')
                ->first();
        } catch (\Throwable $th) {
            $this->items = [
                'total_price' => 0,
                'ongkir' => 0
            ];
        }
    }

    public function payNow()
    {

        $this->dispatch('openModalPayment-' . Auth::user()->id . '-' . session()->getId());
    }

    public function requestSnapToken()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');

        $midtransSnapParams = [
            'transaction_details' => [
                'order_id' => 'invoice-lara' . Carbon::now()->format('YmdHis'),
                'gross_amount' => $this->items->total_price + $this->items->ongkir + 1000,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'billing_address' => [
                    'first_name' => Auth::user()->name,
                    'last_name' => '',
                    'email' => Auth::user()->email,
                    'address' => UserDetail::where('user_id', Auth::user()->id)->first()->alamat_lengkap,
                ]
            ],
            'callbacks' => route('frontend.payment', ['user_id' => Auth::user()->id]),
        ];


        return \Midtrans\Snap::getSnapToken($midtransSnapParams);
    }

    public function navigatedToRoute($params)
    {

        Transaction::updateOrCreate(['user_id' => Auth::user()->id, 'status' => 'pending'], [
            'transaction_id' => $params
        ]);
        $this->redirect(route('frontend.detailpembayaran', ['user_id' => Auth::user()->id, 'order_id' => $params]), true);
    }

    public function updateStatusPayment($transactionId, $status)
    {
        Transaction::updateOrCreate([
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'transaction_id' => $transactionId
        ], [
            'status' => $status
        ]);
    }


    public function render()
    {
        return view('frontend::pages.payment');
    }
}
