<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\City;
use App\Models\Provinsi;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Frontend\Helpers\AbstractFrontendClass;
use Ramsey\Uuid\Uuid;

class Register extends AbstractFrontendClass
{
    protected static string|array $middleware = 'guest';
    public $username = '';
    public $email = '';
    public $password = '';
    public $terms = '';
    public $konfirmasi_password = '';
    public $nama_lengkap = '';
    public $provinsi = '';
    public $no_telp = '';
    public $kabupaten = '';
    public $kecamatan = '';
    public $kodepos = '';
    public $alamat_lengkap = '';

    public $provinsis;

    public function mount()
    {
        $this->provinsis = Provinsi::all();
    }

    public function getCities($provinsi)
    {
        $cities = City::where('province_id', $provinsi)->get();
        return $cities;
    }
    public function register()
    {
        $this->validate();
        try {
            $user = User::create([
                'name' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
            UserDetail::create([
                'alamat_lengkap' => $this->alamat_lengkap,
                'notelp' => $this->no_telp,
                'provinsi' => $this->provinsi,
                'kabupaten' => $this->kabupaten,
                'kecamatan' => $this->kecamatan,
                'kodepos' => $this->kodepos,
                'user_id' => $user->id
            ]);
            $user->assignRole('member');
            Auth::login($user);
            $this->redirect(route('frontend.home'));
            $this->callAlert('success', 'Register Success');
        } catch (\Exception $th) {
            // throw $th;  //For debugging logic create new users
        }
    }

    protected function rules(): array
    {
        return [
            'username' => 'required|min:4|unique:users,name|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'konfirmasi_password' => 'required|same:password',
            'terms' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kodepos' => 'required',
            'alamat_lengkap' => 'required',
            'no_telp' => 'required',
            'nama_lengkap' => 'required'
        ];
    }
    public function render()
    {
        return view('frontend::pages.register');
    }
}
