<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\Cart;
use App\Models\City;
use App\Models\Orders;
use App\Models\Provinsi;
use App\Models\Transaction;
use App\Models\UserDetail;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Modules\Frontend\Helpers\AbstractFrontendClass;
use Ramsey\Uuid\Uuid;

class Keranjang extends AbstractFrontendClass
{

    protected static $middleware = ["auth", "role:admin|member|super_admin"];
    public $modalId;
    public $items;
    public $wire;
    public $address;
    public ?array $dataOngkir = [
        'provinsi' => '',
        'kabupaten' => '',
        'result' => '',
        'cost' => '',
        'service' => '',
        'description' => '',
        'estimate' => '',
    ];
    public ?array $dataAlamat = [
        'provinsi' => '',
        'kabupaten' => '',
    ];

    public $totalOngkir = 0;

    public $resultOngkir;

    public $resultOngkirWhenUserDetailIsNotNull;

    protected $provinces;
    protected $cities;

    public $notes = null;



    public function mount()
    {
        $this->wire = $this->__id;
        $this->address = $this->getUserAddress();
        $this->modalId = Auth::user()->id;
        $this->items = Cart::with('product')->where('user_id', Auth::user()->id)->with('user')->get();
        if ($this->address !== null) {
            $response = $this->cekOngkirAction($this->address->kabupaten);
            $this->resultOngkirWhenUserDetailIsNotNull = Cache::remember("ongkir_{$this->address->kabupaten}", now()->addMinutes(60), function () use ($response) {
                return $response['costs'];
            });
        }
    }

    protected function getUseraddress()
    {
        try {
            $userDetails = UserDetail::with('user')->where('user_id', Auth::user()->id)->first();
            return $userDetails;
            //code...
        } catch (\Illuminate\Database\QueryException $th) {
            return null;
        }
    }


    public function loadCities($id =  null)
    {
        $provinceId = $id ?? $this->dataOngkir['provinsi'];
        $cacheKey = config('app.key') . "_cities_{$provinceId}";
        $ttl = now()->addMinutes(60);

        $response = Cache::remember($cacheKey, $ttl, function () use ($provinceId) {
            return City::where('province_id', $provinceId)
                ->select('city_id', 'city_name', 'postal_code', 'type')
                ->get()
                ->map(function ($city) {
                    return [
                        'city_id' => $city->city_id,
                        'city_name' => "{$city->type} {$city->city_name}",
                        'postal_code' => $city->postal_code,
                    ];
                })
                ->toArray();
        });

        return collect($response);
    }


    public function loadProvincies()
    {

        $cacheKey = config('app.key');
        $ttl = now()->addMinutes(60);

        $apiDataProvinces = Cache::remember("province_{$cacheKey}", $ttl, function () {
            return Provinsi::select('province_id', 'province')->get()->toArray(); // Ambil semua data provinsi
        });
        return collect($apiDataProvinces);
    }

    public function changeQuantity($id, $type)
    {
        $cart = Cart::find($id);
        switch ($type) {
            case 'decrease':
                $this->dispatch('updateCart');
                if ($cart->quantity == 1) {
                    $this->callAlert('danger', 'Quantity minimal 1!');
                    break;
                }
                $cart->update([
                    'quantity' => intval($cart->quantity) - 1,
                    'sub_total' => $cart->product->price * (intval($cart->quantity) - 1),
                ]);
                $this->callAlert('success', 'Berhasil update quantity barang!');
                break;
            default:
                $this->dispatch('updateCart');
                $cart->update([
                    'quantity' => intval($cart->quantity) + 1,
                    'sub_total' => $cart->product->price * (intval($cart->quantity) + 1),
                ]);
                $this->callAlert('success', 'Berhasil update quantity barang!');
                break;
        }
    }
    public function cekOngkir()
    {
        $this->dispatch('openModalCekongkir');
        $this->loadProvincies();
    }




    protected function requestApi($params)
    {
        $endpoint = "https://api.rajaongkir.com/starter/";
        $client = new Client();
        try {
            $response = $client->request($params['method'] ?? 'GET', "{$endpoint}{$params['endpoint']}", [
                'headers' => [
                    'key' => config('services.rajaongkir.key'),
                    $params['headers'] ?? null
                ],
                'form_params' => $params['form_params'] ?? null
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\ClientException $th) {
            return $th->getMessage();
        }
    }

    public function cekOngkirAction($id = null): Collection
    {
        $origin = config('services.rajaongkir.origin');
        $courier = config('services.rajaongkir.courier');
        $destination = $id ?? $this->dataOngkir['kabupaten'];
        $weight = $this->items->sum('weight');

        $response = $this->requestApi([
            'method' => 'POST',
            'endpoint' => 'cost',
            'headers' => 'Content-Type: application/x-www-form-urlencoded',
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]
        ]);

        return collect($response['rajaongkir']['results'][0]);
    }



    public function removeItem($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        $this->dispatch('updateCart');
        $this->callAlert('success', 'Berhasil menghapus item dari keranjang!');
    }

    public function setOngkir($service, $cost, $estimate, $description)
    {
        $this->dispatch('updatedOngkir');
        $this->callAlert('success', 'Berhasil memilih jasa pengiriman!');
        $this->totalOngkir = $cost;
        $this->dataOngkir['service'] = $service;
        $this->dataOngkir['cost'] = $cost;
        $this->dataOngkir['estimate'] = $estimate;
        $this->dataOngkir['description'] = $description;
    }

    public function checkout()
    {

        if ($this->totalOngkir == 0) {
            $this->callAlert('danger', 'Silahkan pilih jasa pengiriman terlebih dahulu!');
        } else {
            try {
                $products = [];
                $total = 0;

                $orders = Orders::where('user_id', Auth::user()->id)
                    ->where('status', 'pending')
                    ->first();

                if ($orders == null) {
                    foreach ($this->items as $item) {
                        Orders::create([
                            'id' => Uuid::uuid4()->toString(),
                            'user_id' => Auth::user()->id,
                            'grand_total' => $this->totalOngkir,
                            'weight' => $this->items->sum('weight'),
                            'status' => 'pending',
                            'address' => $this->address->alamat_lengkap,
                            'product_id' => $item->product->id,
                            'sub_total' => $item->product->price * $item->quantity,
                            'quantity' => $item->quantity,
                            'notes' => $this->notes
                        ]);
                        $total += $item->grand_total * $item->quantity + $this->totalOngkir;


                        $products[] = collect([
                            'id' => $item->product->id,
                            'name' => $item->product->name,
                            'price' => $item->product->price,
                            'quantity' => $item->quantity,
                            'weight' => $item->product->weight,
                        ])->toArray();
                    }

                    Transaction::create([
                        'user_id' => Auth::user()->id,
                        'products' => $products,
                        'quantity' => $this->items->sum('quantity'),
                        'weight' => $this->items->sum('weight'),
                        'status' => 'pending',
                        'total_price' => $total,
                        'ongkir' => $this->totalOngkir
                    ]);

                    Cart::where('user_id', Auth::user()->id)
                        ->delete();
                    $this->redirect(route('frontend.payment', ['user_id' => Auth::user()->id]), true);
                } else {
                    $this->callAlert('danger', 'Anda masih memiliki tagihan yang belum dibayar!');
                    $transaction_id = Transaction::where('user_id', Auth::user()->id)
                        ->orWhere('status', 'pending')
                        ->first()->transaction_id;
                    $this->dispatch('redirectOnPaymentIsNotNull', [
                        'url' => route('frontend.detailpembayaran', [
                            'user_id' => Auth::user()->id,
                            'order_id' => $transaction_id
                        ]),
                        'delay' => 4000
                    ]);
                }
            } catch (\Exception $th) {
                dd($th->getMessage());
                $this->callAlert('danger', 'Ups terjadi kesalahan!');
            }
        }
    }


    #[On('updateCart')]
    public function render()
    {
        $cart = collect($this->items);
        if ($this->items->count() > 0) {
            $originalPrice = $cart->pluck('sub_total')->sum() / $cart->pluck('quantity')->sum();
            $originalPriceFormated = 'Rp ' . number_format($originalPrice, 0, ',', '.');
        } else {
            $originalPrice = 0;
            $originalPriceFormated = 'Rp ' . number_format($originalPrice, 0, ',', '.');
        }
        return view('frontend::pages.keranjang', [
            'items' => $this->items,
            'cart' => $cart,
            'originalPriceFormated' => $originalPriceFormated,
            'totalOngkir' => $this->totalOngkir,
            'address' => $this->address,
            'resultOngkirOnUserDetailIsNotNull' => $this->resultOngkirWhenUserDetailIsNotNull
        ]);
    }

    public function openModalAddress()
    {
        $this->dispatch('openModalAddress');
    }

    public function setNotes()
    {
        if ($this->notes === '') {
            $this->callAlert('danger', 'Catatan tidak boleh kosong!');
        } else {
            $this->callAlert('success', 'Berhasil memberikan catatan!');
        }
    }
}
