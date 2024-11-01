<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io') }}/site.webmanifest">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>{{ $title ?? config('app.name') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.10.5/dist/algoliasearch-lite.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/instantsearch.css@7/themes/satellite-min.css" />
    @if (!Auth::check())
        @vite(['resources/css/app.css', 'resources/js/unauthenticate.js', 'resources/js/global.js'])
        <script>
            window.PageProps = {
                algoliaEnv: {
                    appId: @json(env('ALGOLIA_APP_ID')),
                    apiKey: @json(env('ALGOLIA_API_KEY'))
                },
                appUrl: @json(env('APP_URL'))
            }
        </script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/global.js'])
        <script>
            window.PageProps = {
                user: @json(Auth::user()->toArray()),
                session: @json(session()->getId()),
                algoliaEnv: {
                    appId: @json(env('ALGOLIA_APP_ID')),
                    apiKey: @json(env('ALGOLIA_API_KEY'))
                },
                appUrl: @json(env('APP_URL'))
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
            <livewire:frontend-sub-component::globalsearch />
            <div class="pt-2">
                {{ $slot }}
            </div>
            <x-frontend-component::footer />
        @endif
    @else
        <livewire:frontend-sub-component::navbar />
        <livewire:frontend-sub-component::globalsearch />

        <div class="pt-2">
            {{ $slot }}
        </div>
        <x-frontend-component::footer />
        {{-- @include('frontend::layouts.footer') --}}
    @endif
    @filamentScripts
    @livewireScripts
    @stack('js')
</body>

</html>
