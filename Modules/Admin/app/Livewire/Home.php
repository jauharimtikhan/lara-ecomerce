<?php

namespace Modules\Admin\App\Livewire;

use Livewire\Attributes\Title;
use Modules\Admin\Helpers\AbstractAdminClass;

class Home extends AbstractAdminClass
{
    protected static string|array $middleware = ['auth', 'role:admin'];

    protected static ?string $navigationLabel = 'Home';
    protected static $navigationIcon = 'heroicon-s-home';
    protected static ?string $heading = 'Home';
    protected static bool $headerAction = false;

    #[Title('Home | Lara Ecomerce')]
    public function render()
    {
        return view('admin::pages.home');
    }


    protected function pages(): string|array
    {
        return [
            Home::class,
        ];
    }
}
