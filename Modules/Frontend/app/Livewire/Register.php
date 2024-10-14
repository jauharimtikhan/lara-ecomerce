<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Frontend\Helpers\AbstractFrontendClass;
use Ramsey\Uuid\Uuid;

class Register extends AbstractFrontendClass
{
    public $username = '';
    public $email = '';
    public $password = '';
    public $terms = '';
    public $konfirmasi_password = '';


    public function register()
    {
        $this->validate();
        try {
            User::create([
                'name' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
            $this->redirect(route('frontend.home'));
            $this->callAlert('success', 'Register Success');
        } catch (\Exception $th) {
            // throw $th;  //For debugging logic create new users
        }
    }

    protected function rules(): array
    {
        return [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'konfirmasi_password' => 'required',
            'terms' => 'required',
        ];
    }
    public function render()
    {
        return view('frontend::pages.register');
    }
}
