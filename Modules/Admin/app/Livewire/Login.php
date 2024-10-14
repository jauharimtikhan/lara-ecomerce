<?php

namespace Modules\Admin\App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Helpers\AbstractAdminClass;

class Login extends AbstractAdminClass
{
    protected static string|array $middleware = ['guest'];
    protected static ?string $navigationLabel = '';
    protected static ?string $navigationIcon = 'fas-check';
    public  $email = '';
    public $password = '';

    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ];
    }
    public function login()
    {


        $this->validate();

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', 'Email tidak ditemukan');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Password tidak sesuai');
            return;
        }
        if (!Auth::attempt($this->validate())) {
            $this->addError('email', 'Email dan Password tidak sesuai');
            return;
        }
        Auth::login($user);
        $this->redirectWithAction(route('admin.home'))->callAlert('success', 'Login Berhasil');
    }

    public function render()
    {
        return view('admin::pages.login');
    }
}
