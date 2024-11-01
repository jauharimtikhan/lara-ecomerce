<?php

namespace App\Http\Controllers;

use App\Events\TransactionStatusUpdated;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhookController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        // Config::$serverKey = config('services.midtrans.server_key');
        // Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        // Config::$isSanitized = true;
        // Config::$is3ds = true;
    }

    public function handle(Request $request)
    {
        dd($request);
        try {
            // // Ambil notifikasi dari Midtrans
            // $notification = new Notification();

            // // Dapatkan ID transaksi dan status dari notifikasi
            // $transactionId = $notification->transaction_id;
            // $transactionStatus = $notification->transaction_status;
            // $fraudStatus = $notification->fraud_status;
            // // Cari transaksi di database berdasarkan transaction_id
            // // $transaction = Transaction::where('transaction_id', $transactionId)->first();

            // // if (!$transaction) {
            // //     return response()->json(['message' => 'Transaction not found'], 404);
            // // }

            // // // Update status transaksi berdasarkan status dari Midtrans
            // // if ($transactionStatus == 'capture') {
            // //     if ($fraudStatus == 'challenge') {
            // //         $transaction->status = 'pending';
            // //     } else {
            // //         $transaction->status = 'success';
            // //     }
            // // } elseif ($transactionStatus == 'settlement') {
            // //     $transaction->status = 'success';
            // // } elseif ($transactionStatus == 'pending') {
            // //     $transaction->status = 'pending';
            // // } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            // //     $transaction->status = 'failed';
            // // }

            // // // Simpan perubahan ke database
            // // $transaction->save();
            // event(new TransactionStatusUpdated($transactionId));


            return response()->json(['message' => 'Notification handled successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error handling notification'], 500);
        }
    }
}
