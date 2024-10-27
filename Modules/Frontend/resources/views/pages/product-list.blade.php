<div>
    <section class="bg-gray-50 py-16 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <div>
                    <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                        @php
                            $clearPrefix = str_replace('_', ' ', $searchQuery);
                        @endphp
                        Kategori: {{ ucfirst($clearPrefix) }}</h2>
                </div>

            </div>
            <div class="col-span-8 mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                @if ($products == null)
                    <section class="bg-white dark:bg-gray-900 col-span-4">
                        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                            <div class="mx-auto max-w-screen-sm text-center">
                                <h1
                                    class="animate-pulse mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                                    404</h1>
                                <p
                                    class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                                    Wadooh</p>
                                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Yah, Produk yang
                                    anda cari tidak ditemukan</p>
                                <a href="{{ route('frontend.home') }}" wire:navigate
                                    class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">
                                    Kembali Ke Beranda
                                </a>
                            </div>
                        </div>
                    </section>
                @else
                    {{-- @dd($products) --}}
                    @foreach ($products as $prod)
                        <livewire:frontend-sub-component::productcard :product="$prod" lazy :key="$prod->id" />
                    @endforeach

                @endif
            </div>
            @if ($products->hasMorePages())
                <div class="w-full text-center">
                    <x-filament::button type="button" color="primary" wire:click="loadMore">Lebih
                        Banyak</x-filament::button>
                </div>
            @endif
        </div>
        {{-- Filter Modal --}}
    </section>
</div>
