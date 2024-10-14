<?php

use Modules\Admin\App\Providers\AdminServiceProvider;
use Modules\Frontend\App\Providers\FrontendServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    FrontendServiceProvider::class,
    AdminServiceProvider::class,
];
