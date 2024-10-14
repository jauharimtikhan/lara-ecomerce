<?php

namespace Modules\Frontend\App\Livewire;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Frontend\Helpers\AbstractFrontendClass;

class Login extends AbstractFrontendClass
{
    protected static string|array $middleware = 'guest';
    public $email = '';
    public $password = '';

    protected function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function login()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();
        if ($user && Hash::check($this->password, $user->password)) {
            if (Auth::attempt($this->validate())) {
                $this->redirect(route('frontend.home'));
                $this->callAlert('success', 'Login Success');
            } else {
                $this->callAlert('danger', 'Login Failed');
            }
        } else {
            $this->callAlert('danger', 'User tidak ditemukan');
        }
    }

    public function render()
    {
        return view('frontend::pages.login');
    }
}
