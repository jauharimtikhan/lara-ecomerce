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
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ModalAddress extends Component implements HasForms
{
    use InteractsWithForms;

    public $apiDataProvinces;
    public $apiDataCities;
    public ?array $data = [];

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
        $cacheKey = config('app.key') . "_cities_{$provinceId}";
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
            ->model(UserDetail::class)
            ->schema([
                Grid::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->placeholder('Masukan Nama Lengkap'),
                    TextInput::make('phone')
                        ->label('Nomor Telepon')
                        ->placeholder('Masukan Nomor Telepon'),
                ])->columns(1),
                Grid::make()->schema([
                    Select::make('province')
                        ->options(fn() => collect($this->apiDataProvinces)->pluck('province', 'province_id'))
                        ->label('Provinsi')
                        ->live() // Memanggil fungsi ketika nilai diubah
                        ->afterStateUpdated(fn($state) => $this->updatedDataProvince($state)),

                    Select::make('city')
                        ->options(fn() => collect($this->apiDataCities)->pluck('city_name', 'city_id'))
                        ->disabled(fn() => empty($this->apiDataCities))
                        ->label('Kota/Kabupaten')
                        ->live()
                        ->afterStateUpdated(function ($state, Set $set) {
                            $set('postal_code', collect($this->loadCitiesPostalCode($state))->pluck('postal_code'));
                        }),
                    TextInput::make('kecamatan')
                        ->label('Kecamatan')
                        ->placeholder('Masukan Nama Kecamatan'),
                    TextInput::make('kelurahan')
                        ->label('Kelurahan')
                        ->placeholder('Masukan Nama Kelurahan'),
                    TextInput::make('dusun')
                        ->label('Dusun')
                        ->placeholder('Masukan Nama Dusun'),
                    TextInput::make('postal_code')
                        ->label('Kode Pos')
                        ->placeholder('Masukan Kode Pos'),
                ]),
                Textarea::make('address')
                    ->label('Alamat Lengkap')
                    ->placeholder('contoh: Jl. Raya No. 1'),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('frontend::components.modal-address');
    }
}
