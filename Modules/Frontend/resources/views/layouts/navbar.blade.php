<nav id="navbarContainer" class="bg-white  top-0 left-0 w-full z-30 dark:bg-gray-800 antialiased" wire:ignore.self>
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
        <div class="flex items-center justify-between">

            <div class="flex items-center space-x-8">
                <div class="shrink-0">
                    <a href="{{ route('frontend.home') }}" wire:navigate title="Brand"
                        class="flex items-center space-x-2">
                        <img class="block w-auto h-8 animate-bounce" src="{{ asset('frontend/img/logo.png') }}"
                            alt="">
                        <span class="dark:text-gray-200"> {{ config('app.name') }}</span>
                    </a>
                </div>

                <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">

                    @if (Auth::check())
                        @foreach ($items as $item)
                            @foreach ($item as $it)
                                @php
                                    $url = urlencode($it->name);
                                @endphp
                                @if ($it->subcategory->count() > 0)
                                    <li wire:key="{{ $it->id }}" wire:ignore.self>
                                        <button id="mega-menu-dropdown-button-{{ $it->id }}"
                                            data-dropdown-toggle="mega-menu-icons-dropdown-{{ $it->id }}"
                                            class="flex items-center text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                                            {{ ucfirst($it->name) }}
                                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <div id="mega-menu-icons-dropdown-{{ $it->id }}"
                                            class="absolute z-[100] grid hidden w-auto grid-cols-2 text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-3 dark:bg-gray-700">
                                            <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
                                                <ul class="space-y-4"
                                                    aria-labelledby="mega-menu-icons-dropdown-button-{{ $it->id }}">
                                                    @foreach ($it->subcategory as $subcategory)
                                                        <li>
                                                            <a href="{{ route('frontend.product', ['category' => $it->name, 'subcategory' => $subcategory->name]) }}"
                                                                class="flex items-center text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-500 group">
                                                                <span class="sr-only">{{ $subcategory->name }}</span>

                                                                {{ $subcategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('frontend.product', ['category' => $url]) }}" wire:navigate
                                            class="flex items-center text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                                            {{ ucfirst($it->name) }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                </ul>
            </div>

            <div class="flex items-center lg:space-x-2">


                <form class="md:flex hidden  items-center max-w-sm mx-auto">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">

                        <input type="text" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Cari Produk..." required />
                    </div>
                    <button type="submit"
                        class="p-2.5 ms-2 text-sm font-medium text-white bg-primary-700 rounded-lg border border-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </form>



                <button id="theme-toggle" type="button" wire:ignore.self
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>


                @if (Auth::check())
                    <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1-{{ Auth::user()->id }}"
                        type="button"
                        class="inline-flex items-center relative rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                        <span class="sr-only">
                            Keranjang
                        </span>
                        <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                        </svg>
                        <span class="hidden sm:flex">Keranjang</span>
                        <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>


                        <div
                            class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                            {{ $cartCount }}
                        </div>
                    </button>

                    <div id="myCartDropdown1-{{ Auth::user()->id }}"
                        class="hidden z-[400] mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
                        @foreach ($carts as $cart)
                            <div class="grid grid-cols-2" wire:key="{{ $cart->id }}">
                                <div>
                                    <a href="#"
                                        class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">
                                        {{ $cart->product->name }}
                                    </a>
                                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ $cart->product->formatRupiah() }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-end gap-6">
                                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty:
                                        {{ $cart->quantity }}
                                    </p>

                                    <button data-tooltip-target="tooltipRemoveItem1a-{{ $cart->id }}"
                                        type="button"
                                        wire:click="removeItemFromCart('{{ $cart->id }}', '{{ $cart->product->id }}')"
                                        class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                        <span class="sr-only"> Remove </span>
                                        <svg wire:loading.remove
                                            wire:target="removeItemFromCart('{{ $cart->id }}', '{{ $cart->product->id }}')"
                                            class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @svg('bx-loader-alt', [
                                            'class' => 'h-4 w-4 animate-spin',
                                            'wire:loading',
                                            'wire:target' => "removeItemFromCart('{{ $cart->id }}', '{{ $cart->product->id }}')",
                                            'fill' => 'currentColor',
                                        ])
                                    </button>
                                    <div id="tooltipRemoveItem1a-{{ $cart->id }}" role="tooltip"
                                        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                        Hapus dari keranjang
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr class="bg-gray-700 dark:bg-gray-500 my-4">
                        <a href="{{ route('frontend.keranjang', [
                            'cart_id' => Auth::user()->id,
                        ]) }}"
                            wire:navigate
                            class="text-center flex justify-center text-gray-600 dark:text-gray-200 underline hover:text-gray-700 dark:hover:text-gray-300">Lihat
                            Semua</a>


                        <a href="#"
                            class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            role="button"> Checkout Sekarang </a>
                    </div>

                    <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button"
                        class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                        <span class="sr-only">
                            Account
                        </span>
                        <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="hidden sm:flex">Profil</span>
                        <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="userDropdown1"
                        class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
                        <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                            <li><a href="#"
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Akun </a></li>
                            <li>
                                <a href="#"
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Pesanan Saya
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Pengaturan
                                </a>
                            </li>

                        </ul>

                        <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('frontend.logout') }}"
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Log out</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('frontend.login') }}"
                        class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                        <span class="sr-only">
                            Account
                        </span>
                        <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="hidden sm:flex">Login</span>
                    </a>
                @endif


                <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1"
                    aria-controls="ecommerce-navbar-menu-1" aria-expanded="false"
                    class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white">
                    <span class="sr-only">
                        Open Menu
                    </span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="ecommerce-navbar-menu-1" wire:ignore
            class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
            <ul class="text-gray-900 dark:text-white text-sm font-medium space-y-3">
                <li>
                    <a href="{{ route('frontend.home') }}"
                        class="hover:text-primary-700 dark:hover:text-primary-500">Home</a>
                </li>
                <li>
                    <a href="{{ route('frontend.product', ['category' => 'pria']) }}"
                        class="hover:text-primary-700 dark:hover:text-primary-500">Pria</a>
                </li>
                <li>
                    <a href="{{ route('frontend.product', ['category' => 'wanita-anak']) }}"
                        class="hover:text-primary-700 dark:hover:text-primary-500">Wanita & Anak</a>
                </li>
                <li>
                    <a href="{{ route('frontend.product', ['category' => 'perlengkapan']) }}"
                        class="hover:text-primary-700 dark:hover:text-primary-500">Perlengkapan</a>
                </li>
                <li>
                    <form class="flex md:hidden items-center max-w-sm ">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">

                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Cari Produk..." required />
                        </div>
                        <button type="submit"
                            class="p-2.5 ms-2 text-sm font-medium text-white bg-primary-700 rounded-lg border border-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
@script
    <script>
        const navbarContainer = document.getElementById("navbarContainer");
        navbarContainer.classList.add("fixed");
        window.addEventListener("scroll", () => {
            if (window.scrollY >= 0) {
                navbarContainer.classList.add("fixed");
                navbarContainer.style.transition =
                    "all 0.3s ease-in-out"; // Properti transition diatur setelah class ditambahkan
            } else {
                navbarContainer.classList.remove("fixed");
                navbarContainer.style.transition =
                    "all 0.3s ease-in-out"; // Masih memberikan transisi meskipun class dihapus
            }
        });
    </script>
@endscript
