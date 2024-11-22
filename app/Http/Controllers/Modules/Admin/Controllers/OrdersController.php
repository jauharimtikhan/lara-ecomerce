<?php

namespace App\Http\Controllers\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Modules\Frontend\Helpers\to_json;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Transaction::with('userDetail', 'user')
            ->orderByDesc('created_at')
            ->count();
        $success = Transaction::with('userDetail', 'user')
            ->where('status', 'selesai')
            ->orderByDesc('created_at')
            ->count();
        $pending = Transaction::with('userDetail', 'user')
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->count();
        $perluDikirim = Transaction::with('userDetail', 'user')
            ->where('status', 'settlement')
            ->orderByDesc('created_at')
            ->count();
        $failed = Transaction::with('userDetail', 'user')
            ->where('status', 'expiry')
            ->orderByDesc('created_at')
            ->count();
        return view('admin::pages.pesanan.index', [
            'all' => $all,
            'success' => $success,
            'pending' => $pending,
            'perluDikirim' => $perluDikirim,
            'expiry' => $failed,
        ]);
    }

    public function getAllData($type)
    {
        try {
            if ($type == 'all') {
                $orders = Transaction::with(['userDetail', 'user', 'products'])
                    ->orderByDesc('created_at')
                    ->paginate(10);
            } elseif ($type == 'pending') {
                $orders = Transaction::with(['userDetail', 'user', 'products'])
                    ->orderByDesc('created_at')
                    ->where('status', 'pending')
                    ->paginate(10);
            } elseif ($type == 'settlement') {
                $orders = Transaction::with(['userDetail', 'user', 'products'])
                    ->orderByDesc('created_at')
                    ->where('status', 'settlement')
                    ->paginate(10);
            } elseif ($type == 'expiry') {
                $orders = Transaction::with(['userDetail', 'user', 'products'])
                    ->orderByDesc('created_at')
                    ->where('status', 'expiry')
                    ->paginate(10);
            } elseif ($type == 'selesai') {
                $orders = Transaction::with(['userDetail', 'user', 'products'])
                    ->orderByDesc('created_at')
                    ->where('status', 'selesai')
                    ->paginate(10) ?? null;

            } else {
                return response()->json(['message' => 'Type not found', 'status' => false], 404);
            }

            $result = collect($orders->items())->map(function ($record) {
                return [
                    'id' => $record->id,
                    'nama_user' => $record->user->name,
                    'email_user' => $record->user->email,
                    'user_id' => $record->user_id,
                    'product' => collect($record->products)->map(function ($product) use ($record) {
                        return [
                            'id' => $product['id'],
                            'name' => $product['name'],
                            'thumbnail' => $record->product($product['id'])->gambarThumbnail->url ?? null,
                            'harga_produk' => $product['price'],
                            'description' => $record->product($product['id'])->description,
                            'qty' => $product['quantity'],
                            'diskon' => $record->product($product['id'])->discount,
                        ];
                    }),
                    'total_price' => $record->total_price,
                    'status' => $record->status,
                    'weight' => $record->weight,
                    'transaction_id' => $record->transaction_id,
                    'quantity' => $record->quantity,
                    'created_at' => $record->formatDate(),
                    'ongkir' => $record->ongkir,
                    'detail_user' => [
                        'alamat_lengkap' => $record->userDetail->alamat_lengkap,
                        'notelp' => $record->userDetail->notelp
                    ],
                    'tgl_pengiriman' => $record->dateToDelivery(),
                    'note' => $record->note,
                ];
            });

            return to_json([
                'data' => $result,
                'total_item' => $orders->total(),
                'total_page' => $orders->lastPage(),
                'current_page' => $orders->currentPage(),
                'per_page' => $orders->perPage(),
                'links' => $orders->linkCollection()
            ], 200);
        } catch (\Exception $th) {
            return to_json([
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
