<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io') }}/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('favicon_io') }}/site.webmanifest">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <title>{{ $title ?? config('app.name') }}</title>
    @if (Auth::check())
        @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @else
        @vite(['resources/css/admin.css', 'resources/js/unauthenticate.js'])
    @endif
    @livewireStyles
    @filamentStyles
</head>

<body>
    @livewire('notifications')
    <livewire:admin-component::alert />
    @if (!Auth::check())
        {{ $slot }}
    @else
        @include('admin::layouts.navbar')
        <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
            @include('admin::layouts.sidebar')
            <div id="main-content"
                class="relative w-full h-screen overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
                <main class="px-4 pt-6">
                    <x-admin-component::headingsection />
                    {{ $slot }}
                </main>
                @include('admin::layouts.footer')
            </div>
        </div>
    @endif
    @filamentScripts
    @livewireScripts
</body>

</html>
