<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Orders;
use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class DetailPembayaran extends AbstractFrontendClass
{
    protected static string|array $middleware = ['auth', 'role:member|admin|super_admin'];

    public $order_id = '';
    public $status;
    public $orders;
    public $midtransData;
    public $formatedDate;
    public $expiryTime;
    public $frontData = [];

    public function mount()
    {
        $this->order_id = request()->get('order_id');
        $this->orders = Orders::where('user_id', Auth::user()->id)->first();

        // Memanggil metode untuk mendapatkan data Midtrans
        $this->getMidtransData($this->order_id);
    }

    public function getMidtransData($order_id)
    {
        $response = $this?->loadMidtrans($order_id);

        if ($response) {
            $this->midtransData = collect($response);
            $this->status = $response['transaction_status'];

            // Format tanggal menggunakan lokal Bahasa Indonesia
            Carbon::setLocale('id');
            $this->formatedDate = Carbon::parse($response['transaction_time'])->isoFormat('dddd, D MMMM Y HH:mm:ss');
            $this->expiryTime = Carbon::parse($response['expiry_time'])->isoFormat('dddd, D MMMM Y HH:mm:ss');

            // Update status pesanan dan transaksi
            $this->updateOrderAndTransactionStatus($response['transaction_status']);
        }
    }

    protected function updateOrderAndTransactionStatus($status)
    {
        // Update status untuk pesanan yang sedang pending
        Orders::where('user_id', Auth::user()->id)
            ->where('status', 'pending')
            ->update(['status' => $status]);

        // Update status transaksi dan atur transaction_id jika diperlukan
        Transaction::where('user_id', Auth::user()->id)
            ->where('status', 'pending')
            ->each(function ($trans) use ($status) {
                if ($trans->transaction_id === null || $trans->transaction_id === $this->order_id) {
                    $trans->update([
                        'status' => $status,
                        'transaction_id' => $this->order_id
                    ]);
                }
            });
    }

    public function loadMidtrans($order_id)
    {
        try {
            $client = new Client();
            $url = config('services.midtrans.is_production') ?
                "https://api.midtrans.com/v2" :
                "https://api.sandbox.midtrans.com/v2";

            $response = $client->request('GET', "{$url}/{$order_id}/status", [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => "Basic " . base64_encode(env('MIDTRANS_SERVER_KEY') . ":")
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Throwable $th) {
            // Menangani error secara lebih baik, misalnya dengan logging
            logger()->error("Error loading Midtrans data: " . $th->getMessage());
            return null;
        }
    }

    public function render()
    {
        return view('frontend::pages.detail-pembayaran', [
            'status' => $this->status,
            'formatedDate' => $this->formatedDate,
            'midtransData' => $this->midtransData
        ]);
    }
}
