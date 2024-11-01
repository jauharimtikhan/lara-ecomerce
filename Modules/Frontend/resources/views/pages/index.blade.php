<div class="dark:bg-gray-900">

    {{-- Hero Start --}}
    <section class="bg-white pt-16 pb-0 max-w-screen-xl antialiased dark:bg-gray-900  mx-auto">
        <div class="z-[10] relative dark:bg-gray-900 pb-8 px-6 rounded-lg" data-aos="fade-down">
            <div id="controls-carousel" class="relative w-full  dark:bg-gray-900" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 md:h-[30rem] overflow-hidden dark:bg-gray-900 rounded-lg ">
                    <!-- Item 1 -->

                    @foreach ($dynamicContents->banner() as $dynamicContent)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ $dynamicContent }}"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                    @endforeach

                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 h-full start-0 z-30 flex items-center justify-center  px-4 cursor-pointer group focus:outline-none "
                    data-aos="fade-right" data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 h-full end-0  z-30 flex items-center justify-center  px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>

    </section>
    {{-- Hero end --}}

    <section class="bg-white-50 py-1 antialiased dark:bg-gray-900" data-aos="fade-up" data-aos-duration="300">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->

            <div class="mb-4 grid gap-4 grid-cols-3 md:mb-8 lg:grid-cols-3 xl:grid-cols-6 md:grid-cols-2">
                @foreach ($dynamicContents->CategoryBanner() as $dynamicContent)
                    <div class="h-40 w-full hover:scale-105 hover:transition hover:ease-in-out hover:duration-300">
                        <a wire:navigate
                            href="{{ route('frontend.product', [
                                'category' => urlencode($dynamicContent['title']),
                            ]) }}">
                            <img class="mx-auto h-full  " src="{{ $dynamicContent['url'] }}" alt="" />
                        </a>
                    </div>
                @endforeach
            </div>
    </section>

    {{-- Discount Start --}}
    <section class="px-4 py-1 bg-white dark:bg-gray-900" data-aos="fade-up" data-aos-duration="400">

        <div
            class="mx-auto grid max-w-screen-xl rounded-lg p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16">
            <div class="lg:col-span-5 lg:mt-0">
                <img class="mb-4 h-56 w-56  sm:h-96 sm:w-96 md:h-full md:w-full"
                    src="{{ $dynamicContents->Ads()['banner'] }}" alt="peripherals" />
            </div>
            <div class="me-auto place-self-center lg:col-span-7">
                <h1
                    class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                    {{ $dynamicContents->Ads()['title'] }}
                </h1>
                <div class="mb-6 text-gray-500 dark:text-gray-400">
                    {!! str($dynamicContents->Ads()['description'])->sanitizeHtml() !!}
                </div>
                @isset($dynamicContents->Ads()['cta_label'])
                    <a href="{{ route($dynamicContents->Ads()['cta_link']) }}" wire:navigate
                        class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                        {{ $dynamicContents->Ads()['cta_label'] }}
                    </a>
                @endisset
            </div>
        </div>
    </section>
    {{-- Discount End --}}



    {{-- Latest Product --}}
    @isset($products)
        @if ($products !== null)
        @endif
        <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-12">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <!-- Heading & Filters -->
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                    <div>

                        <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                            Produk Terbaru
                        </h2>
                    </div>

                </div>
                <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($products as $prod)
                        <livewire:frontend-sub-component::productcard :product="$prod" lazy :key="$prod->id" />
                    @endforeach
                </div>
                @if ($products->hasMorePages())
                    <div class="w-full text-center">
                        <x-filament::button type="button" color="primary" wire:click="loadMore">Lebih
                            Banyak</x-filament::button>
                    </div>
                @endif
            </div>
        @else
            <section class="bg-white dark:bg-gray-900 col-span-4">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                    <div class="mx-auto max-w-screen-sm text-center">
                        <h1
                            class="animate-pulse mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                            404</h1>
                        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
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
        </section>
    @endisset
    {{-- End --}}
</div>
