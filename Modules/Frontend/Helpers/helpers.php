<?php

namespace Modules\Frontend\Helpers;

use Illuminate\Support\Facades\Response;

if (!function_exists('module_path')) {
    function module_path($name = '')
    {
        return base_path("Modules\\{$name}");
    }
}


if (!function_exists('to_json')) {
    function to_json($data, $status = 200)
    {
        return Response::json($data, $status);
    }
}
