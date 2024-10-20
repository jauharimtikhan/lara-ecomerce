<?php

namespace Modules\Frontend\App\Livewire\Components;

use App\Models\City;
use App\Models\Provinsi;
use App\Models\UserDetail;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class ModalAddress extends Component implements HasForms
{
    use InteractsWithForms;

    public $apiDataProvinces;
    public $apiDataCities;
    public ?array $data = [
        'address' => ''
    ];

    public function mount()
    {
        $this->loadProvinces();
    }

    protected function loadProvinces()
    {
        $cacheKey = config('app.key');
        $ttl = now()->addMinutes(60);

        $this->apiDataProvinces = Cache::remember("province_{$cacheKey}", $ttl, function () {
            return Provinsi::select('province_id', 'province')->get()->toArray();
        });
    }

    public function updatedDataProvince($provinceId)
    {
        if ($provinceId) {
            $this->loadCities($provinceId);
        }
    }

    protected function loadCities($provinceId)
    {
        $cacheKey = config('app.key') . "_cities_{$provinceId}";
        $ttl = now()->addMinutes(60);

        $this->apiDataCities = Cache::remember($cacheKey, $ttl, function () use ($provinceId) {
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
    }

    protected function loadCitiesPostalCode($provinceId)
    {
        $cacheKey = config('app.key') . "_postal_code_{$provinceId}";
        $ttl = now()->addMinutes(60);

        return Cache::remember($cacheKey, $ttl, function () use ($provinceId) {
            return City::where('city_id', $provinceId)
                ->select('city_id', 'city_name', 'postal_code', 'type')
                ->get()
                ->map(function ($city) {
                    return [
                        'postal_code' => $city->postal_code,
                    ];
                })
                ->toArray();
        });
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->placeholder('Masukan Nama Lengkap')
                        ->required(),
                    TextInput::make('phone')
                        ->label('Nomor Telepon')
                        ->placeholder('Masukan Nomor Telepon')
                        ->required(),
                ])->columns(1),
                Grid::make()->schema([
                    Select::make('province')
                        ->options(fn() => collect($this->apiDataProvinces)->pluck('province', 'province_id'))
                        ->label('Provinsi')
                        ->live()
                        ->required()
                        ->afterStateUpdated(fn($state) => $this->updatedDataProvince($state)),

                    Select::make('city')
                        ->options(fn() => collect($this->apiDataCities)->pluck('city_name', 'city_id'))
                        ->disabled(fn() => empty($this->apiDataCities))
                        ->label('Kota/Kabupaten')
                        ->required()
                        ->live(),
                    TextInput::make('kecamatan')
                        ->label('Kecamatan')
                        ->placeholder('Masukan Nama Kecamatan')
                        ->required(),
                    TextInput::make('kelurahan')
                        ->label('Kelurahan')
                        ->placeholder('Masukan Nama Kelurahan')
                        ->required(),
                    TextInput::make('dusun')
                        ->label('Dusun')
                        ->placeholder('Masukan Nama Dusun')
                        ->required(),
                    TextInput::make('postal_code')
                        ->label('Kode Pos')
                        ->placeholder('Masukan Kode Pos')
                        ->required(),
                ]),
                Textarea::make('address')
                    ->label('Alamat Lengkap')
                    ->placeholder('contoh: Jl. Raya No. 1')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('frontend::components.modal-address');
    }

    public function store()
    {
        $provinceId = $this->form->getState()['city'];
        $this->loadCities($this->form->getState()['province']);
        $address = sprintf(
            'Provinsi %s %s Kecamatan %s Kelurahan %s Dusun %s Kode Pos %s',
            collect($this->apiDataProvinces)->get($this->form->getState()['province'])['province'],
            collect($this->apiDataCities)->where('city_id', $provinceId)->pluck('city_name')[0],
            $this->form->getState()['kecamatan'],
            $this->form->getState()['kelurahan'],
            $this->form->getState()['dusun'],
            $this->form->getState()['postal_code']
        );
        $data = [
            'user_id' => Auth::user()->id,
            'kabupaten' => $this->form->getState()['city'],
            'provinsi' => $this->form->getState()['province'],
            'kecamatan' => $this->form->getState()['kecamatan'],
            'kelurahan' => $this->form->getState()['kelurahan'],
            'notelp' => $this->form->getState()['phone'],
            'alamat_lengkap' => $address,
        ];
        try {
            UserDetail::updateOrCreate(['user_id' => Auth::user()->id], $data);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Berhasil menambahkan alamat pengiriman']);
        } catch (\Illuminate\Database\QueryException $th) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Gagal menambahkan alamat pengiriman']);
        }
    }
}
