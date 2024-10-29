<?php

namespace Modules\Frontend\App\Livewire;

use App\Events\MidtransNotification;
use App\Models\Orders;
use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class DetailPembayaran extends AbstractFrontendClass
{
    protected static string|array $middleware = ['auth', 'role:member|admin|super_admin'];

    public $status = 'pending';
    public $orders;

    public $midtransData;

    public $formatedDate;
    public $expiryTime;


    public function mount()
    {
        $this->orders = Orders::where('user_id', Auth::user()->id)->first();
        if (request()->get('order_id') != null) {
            $response = $this->loadMidtrans(request()->get('order_id'));
            $this->midtransData = collect($response);
            $this->status = $this->midtransData['transaction_status'];
            Carbon::setLocale('id');
            $this->formatedDate = Carbon::parse($response['transaction_time'])->isoFormat('dddd, D MMMM Y HH:mm:ss');
            $this->expiryTime = Carbon::parse($response['expiry_time'])->isoFormat('dddd, D MMMM Y HH:mm:ss');
            Orders::updateOrCreate([
                'user_id' => Auth::user()->id,
                'status' => 'pending'
            ], [
                'status' => $this->midtransData['transaction_status']
            ]);
            Transaction::updateOrCreate([
                'user_id' => Auth::user()->id,
                'status' => 'pending'
            ], [
                'status' => $this->midtransData['transaction_status']
            ]);
        }
    }


    public function handleNotificationMidtrans($notification)
    {
        dd($notification);
    }


    public function loadMidtrans($order_id)
    {

        $client = new Client();
        try {
            $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/' . urldecode($order_id) . '/status', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(config('services.midtrans.server_key') . ':')
                ]
            ]);

            $response = json_decode($response->getBody(), true);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
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
