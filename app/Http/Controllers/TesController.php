<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Provinsi;
use GuzzleHttp\Client;

class TesController extends Controller
{
    public function index()
    {
        try {
            $responseProvinsi = $this->requestApi(['endpoint' => 'province'])['rajaongkir']['results'];
            foreach ($responseProvinsi as $value) {
                Provinsi::findOrNew($value['province_id'], [
                    'province_id' => $value['province_id'],
                    'province' => $value['province']
                ]);

                $responseCities = $this->requestApi(['endpoint' => 'city?province=' . $value['province_id']])['rajaongkir']['results'];
                foreach ($responseCities as $valueCity) {
                    City::findOrNew($valueCity['city_id'], [
                        'city_id' => $valueCity['city_id'],
                        'province_id' => $valueCity['province_id'],
                        'city_name' => $valueCity['city_name'],
                        'postal_code' => $valueCity['postal_code'],
                        'type' => $valueCity['type']
                    ]);
                }
            }
            return response()->json([
                'message' => 'Berhasil Menyimpan Data Geologi Indonesia'
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal Menyimpan Data Geologi Indonesia',
                'exeption' => $th->getMessage()
            ], 500);
        }
    }

    protected function requestApi($params)
    {
        $endpoint = "https://api.rajaongkir.com/starter/";
        $client = new Client();
        try {
            $response = $client->request($params['method'] ?? 'GET', "{$endpoint}{$params['endpoint']}", [
                'headers' => [
                    'key' => config('services.rajaongkir.key'),
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\ClientException $th) {
            return $th->getMessage();
        }
    }
}
