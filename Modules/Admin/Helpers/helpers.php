<?php

use function Modules\Frontend\Helpers\module_path;

if (! function_exists('pathToNameSpace')) {
    function pathToNamespace($path, $basePath = 'Modules')
    {
        // Hapus base path yang tidak perlu
        $relativePath = str_replace(module_path($basePath), '', $path);

        // Hapus ekstensi file (.php)
        $relativePath = str_replace('.php', '', $relativePath);

        // Ubah 'app' menjadi 'App' jika perlu
        $relativePath = preg_replace('/\/app\//', '/App/', $relativePath, 1);

        // Ubah semua '/' menjadi '\'
        $namespace = str_replace('/', '\\', $relativePath);

        return $namespace;
    }
}
