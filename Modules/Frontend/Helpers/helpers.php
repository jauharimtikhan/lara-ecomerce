<?php

namespace Modules\Frontend\Helpers;

if (!function_exists('module_path')) {
    function module_path($name = '')
    {
        return base_path("Modules\\{$name}");
    }
}
