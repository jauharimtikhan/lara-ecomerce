<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhook extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$is3ds = config('services.midtrans.is_3ds');
        Config::$isSanitized = config('services.midtrans.is_sanitized');

    }

    public function handle(Request $request)
    {
        try {
            // Ambil notifikasi dari Midtrans
            $notification = new Notification();

            // Validasi: Pastikan order_id dan status tidak null
            $transaction = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;

            // Log notifikasi untuk debugging
            // Log::info('Midtrans Webhook: ', (array) $notification);

            if (is_null($transaction)) {
                // Log::error('Invalid webhook data: Missing order_id or transaction_status.');
                return response()->json(['message' => 'Invalid data'], 400);
            }

            // Cari transaksi berdasarkan order_id
            // $transactionRecord = Transaction::where('order_id', $orderId)->first();

            // if (!$transactionRecord) {
            //     Log::error("Transaction with order_id {$orderId} not found.");
            //     return response()->json(['message' => 'Transaction not found'], 404);
            // }

            // Update status transaksi berdasarkan status dari Midtrans

            if ($transaction == 'capture') {
                if ($fraudStatus == 'challenge') {
                    // $transactionRecord->update(['status' => 'challenge']);
                } else {
                    // $transactionRecord->update(['status' => 'success']);
                }
            } elseif ($transaction == 'settlement') {
                // $transactionRecord->update(['status' => 'success']);
            } elseif ($transaction == 'pending') {
                // $transactionRecord->update(['status' => 'pending']);
            } elseif (in_array($transaction, ['deny', 'cancel', 'expire'])) {
                // $transactionRecord->update(['status' => 'failed']);
            }


            return response()->json([
                'message' => 'Webhook received successfully',
                'data' => $notification->getResponse()
            ], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Webhook error'], 500);
        }
    }
}
