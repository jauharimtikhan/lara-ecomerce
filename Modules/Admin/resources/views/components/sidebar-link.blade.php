<ul class="pb-2 space-y-2">
    <li>
        <form action="#" method="GET" class="lg:hidden">
            <label for="mobile-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" name="email" id="mobile-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Search">
            </div>
        </form>
    </li>
    @php

        $groupedRoutes = collect($items)->filter(function ($item) {
            return $item['group'];
        });

    @endphp
    @foreach ($items as $item)
        @if ($groupedRoutes->contains($item))
            @php
                $active = '';
                foreach ($item['children'] as $value) {
                    if (Route::currentRouteName() == $value['url']) {
                        $active = $value['url'];
                        break;
                    }
                }

                $destructMiddleware = collect($item['middleware'])
                    ->map(function ($mid, $key) {
                        if (str_contains($mid, 'role:')) {
                            $res = explode(':', $mid)[1];
                            return $res;
                        }
                    })
                    ->filter()
                    ->implode('|');
            @endphp
            @hasanyrole($destructMiddleware)
                <li>
                    <button type="button"
                        class="{{ Route::currentRouteName() == $active ? 'bg-gray-100 dark:bg-gray-700' : '' }} {{ $is_active ? 'bg-gray-100 dark:bg-gray-700' : '' }}  flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-{{ $item['url'] }}-{{ $item['label'] }}"
                        data-collapse-toggle="dropdown-{{ $item['url'] }}-{{ $item['label'] }}">
                        @svg($item['icon'], [
                            'class' => 'flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white',
                        ])
                        @php
                            $groupedRoutesName = $item['group'];
                        @endphp
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $groupedRoutesName }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-{{ $item['url'] }}-{{ $item['label'] }}" class="hidden py-2 space-y-2">
                        @isset($item['children'])
                            @foreach ($item['children'] as $key => $child)
                                @php
                                    $clearPath = $child['label'];
                                @endphp
                                <li>
                                    <a href="{{ route($child['url']) }}"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ ucfirst($clearPath) }}</a>
                                </li>
                            @endforeach
                        @endisset
                    </ul>
                </li>
            @endhasanyrole
            @continue
        @endif
        @isset($item['children'])
            @php
                $active = '';
                foreach ($item['children'] as $value) {
                    if (Route::currentRouteName() == $value['url']) {
                        $active = $value['url'];
                        break;
                    }
                }
                $destructMiddleware = collect($item['middleware'])
                    ->map(function ($mid, $key) {
                        if (str_contains($mid, 'role:')) {
                            $res = explode(':', $mid)[1];
                            return $res;
                        }
                    })
                    ->filter()
                    ->implode('|');

            @endphp
        @endisset
        @hasanyrole($destructMiddleware)
            <li>
                <a href="{{ route($item['name']) }}" wire:navigate wire:key="{{ $item['label'] }}"
                    class="{{ Route::currentRouteName() == $active ? 'bg-gray-100 dark:bg-gray-700' : '' }} {{ $is_active ? 'bg-gray-100 dark:bg-gray-700' : '' }} flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                    @svg($item['icon'], 'w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white')
                    <span class="ml-3" sidebar-toggle-item>{{ $item['label'] }}</span>
                </a>
            </li>
        @endhasanyrole
    @endforeach

</ul>
