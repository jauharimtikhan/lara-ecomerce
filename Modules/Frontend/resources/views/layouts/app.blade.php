<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io') }}/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('favicon_io') }}/site.webmanifest">
    <title>{{ $title ?? config('app.name') }}</title>
    @if (!Auth::check())
        @vite(['resources/css/app.css', 'resources/js/unauthenticate.js'])
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            window.PageProps = {
                user: @json(Auth::user()->toArray()),
                session: @json(session()->getId()),

            }
        </script>
    @endif
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    @filamentStyles
    @livewireStyles
</head>

<body>
    @livewire('notifications')
    @livewire('frontend-sub-component::toast')

    @if (!Auth::check())
        @if (Route::currentRouteName() == 'frontend.login')
            {{ $slot }}
        @else
            <livewire:frontend-sub-component::navbar />
            <div class="mt-8">
                {{ $slot }}
            </div>
        @endif
    @else
        <livewire:frontend-sub-component::navbar />
        <div class="xl:pt-8 md:pt-4">
            {{ $slot }}
        </div>
        @include('frontend::layouts.footer')
    @endif
    @filamentScripts
    @livewireScripts

    @stack('js')
</body>

</html>
