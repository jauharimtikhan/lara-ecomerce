@php
    $headerActionLink = '';
@endphp
<div>
    @if ($breadcrumbs !== [])
        <nav class="flex mb-8 px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($loop->first)
                        @if ($breadcrumb['route'] == str_contains($breadcrumb['route'], 'admin.edit'))
                            @php
                                $breadcrumb['route'] = null;
                            @endphp
                        @else
                            @php
                                $breadcrumb['route'] = route($breadcrumb['route']);
                            @endphp
                        @endif
                        <li class="inline-flex items-center">
                            <a href="{{ $breadcrumb['route'] }}" wire:navigate
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                                @svg($breadcrumb['icon'] ?? 'heroicon-0-home', 'w-3 h-3 me-2.5')
                                {{ $breadcrumb['name'] }}
                            </a>
                        </li>
                    @endif
                    @foreach ($breadcrumb['children'] as $child)
                        @if (str_contains($child['name'], 'Create'))
                            @php
                                $headerActionLink = route($child['route']);
                            @endphp
                            @if (Route::currentRouteName() == $child['route'])
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span
                                            class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $child['name'] }}</span>
                                    </div>
                                </li>
                            @endif
                        @endif
                        @if ($breadcrumb['children'] > 1)
                            @if ($child['name'] == str_contains($child['name'], 'Create') || $child['name'] == str_contains($child['name'], 'Edit'))
                                @continue
                            @endif
                            @if ($loop->last)
                                <li>
                                    <div class="flex items-center">
                                        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <a href="{{ route($child['route']) }}" wire:navigate
                                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">{{ $child['name'] }}</a>
                                    </div>
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </ol>
        </nav>
    @endif
    <div class="mb-3 mt-4 flex justify-between items-center border-b-2 border-gray-200 pb-2 dark:border-gray-700">
        <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl sm:leading-none sm:tracking-tight dark:text-white">
            {{ $heading }}</h1>


        @if ($headerAction)
            <a href="{{ $headerActionLink }}" wire:navigate
                class="text-white  bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Buat</a>
        @endif

        @if ($canQuickAction)
            {!! $quickAction !!}
        @endif
    </div>
</div>
