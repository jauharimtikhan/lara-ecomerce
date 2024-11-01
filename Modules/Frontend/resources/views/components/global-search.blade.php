{{-- <div id="global-search" wire:ignore.self
    class="fixed top-0 hidden py-3 left-1/2 transform bg-gray-300 dark:bg-gray-800 h-full -translate-x-1/2 mt-[4.8rem] w-full z-50 px-3 max-w-screen-xl ">
    <form class="flex items-center w-full px-4">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full ">
            <input type="text" id="inputGlobalSearch" wire:model.live.debounce.300ms="querySearch"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Cari Produk..." required />

            <div id="global-search-result" class="absolute hidden translate-y-[110%] w-full h-full inset-y-0"
                wire:ignore.self>
                <div wire:loading wire:target="querySearch"
                    class="cursor-pointer text-sm antialiased font-bold flex items-center justify-center flex-wrap gap-2 py-2 px-2 rounded-md bg-gray-100 text-gray-900 dark:text-gray-100 dark:bg-gray-700 w-full">
                    @svg('bx-loader-alt', [
                        'class' => 'w-5 h-5 animate-spin',
                    ])
                </div>
                @if (strlen($querySearch) > 0)
                    <div class="flex items-center rounded-lg text-gray-100  flex-wrap">
                        <ul class="flex gap-3 flex-col w-full">
                            @if (count($results) > 0)
                                @foreach ($results as $result)
                                    <li class="w-full">
                                        <a href="{{ route('frontend.productdetail', [
                                            'id' => $result->id,
                                        ]) }}"
                                            class="cursor-pointer text-sm antialiased font-bold flex items-center flex-wrap gap-2 py-2 rounded-md bg-gray-100 text-gray-900 dark:text-gray-100 dark:bg-gray-700">
                                            <div class="w-10">
                                                <img src="{{ $result->gambarThumbnail->hd }}" alt="">
                                            </div>
                                            <span class="truncate overflow-hidden md:w-[90%] w-[50%]">
                                                {{ $result->name }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li
                                    class="cursor-pointer text-sm antialiased font-bold flex items-center flex-wrap gap-2 py-2 px-2 rounded-md bg-gray-100 text-gray-900 dark:text-gray-100 dark:bg-gray-700 w-full">
                                    <span class="truncate overflow-hidden md:w-[90%] w-[50%]">
                                        Hasil TIdak Ditemukan.
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div> --}}

<div class="fixed top-0 hidden py-3 left-1/2 transform -translate-x-1/2 mt-[4.8rem] w-[80%] z-50 max-w-screen-xl "
    id="global-search" wire:ignore>
    <div class="bg-white py-4 px-2 dark:bg-gray-800">
        <header class="header-algolia" class="bg-white dark:bg-gray-600">
            <div id="autocomplete-algolia" class="bg-white dark:bg-gray-600"></div>
        </header>

        <div class="container-algolia" class="bg-white dark:bg-gray-600">
            <div>
                <div id="categories-algolia"></div>
            </div>
            <div>
                <div id="hits-algolia"></div>
            </div>
        </div>
    </div>
</div>
