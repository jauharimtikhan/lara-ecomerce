<?php

namespace App\Http\Controllers;

use App\Events\TransactionStatusUpdated;
use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Notification;

use function Modules\Frontend\Helpers\to_json;

class MidtransWebhookController extends Controller
{
    protected string $url;
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
        config('services.midtrans.is_production') ? $this->url = Config::PRODUCTION_BASE_URL : $this->url = Config::SANDBOX_BASE_URL;
    }

    public function handle(Request $request)
    {

        try {
            // Ambil notifikasi dari Midtrans
            $notification = new Notification();

            // // Dapatkan ID transaksi dan status dari notifikasi
            $transactionId = $notification->transaction_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            // dd($notification);
            // Cari transaksi di database berdasarkan transaction_id
            $transaction = Transaction::where('transaction_id', $transactionId)->first();

            if (!$transaction) {
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            TransactionStatusUpdated::dispatch($notification->getResponse());


            return response()->json(['message' => 'Notification handled successfully', 'res' => $notification->getResponse()], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error handling notification', 'error' => $e->getMessage()], 500);
        }
    }

    public function getStatus(Request $request)
    {
        $client = new Client();
        try {
            $response = $client->request('GET', "{$this->url}/v2/{$request->transaction_id}/status", [
                'headers' => [
                    'Authorization' => "Basic " . base64_encode(config('services.midtrans.server_key') . ":"),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);

            return to_json([
                'status_code' => $response->getStatusCode(),
                'data' => json_decode($response->getBody()->getContents())
            ], $response->getStatusCode());
        } catch (\Exception $th) {
            return to_json([
                'status_code' => [],
                'data' => [],
                'errors' => $th->getMessage()
            ], $th->getCode());
        }
    }
}
