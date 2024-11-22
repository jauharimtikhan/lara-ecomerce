<div>
    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-1 md:grid md:grid-cols-2 md:gap-12">
                <div class="flex flex-col gap-4">
                    <div class="shrink-0 max-w-md w-full mx-auto bg-gray-100 rounded-lg p-4 flex justify-center">
                        <img class="w-48 rounded-lg drop-shadow-lg mb-5" id="image-product-{{ $product->id }}"
                            src="{{ $product->gambarThumbnail->largeUrl }}"
                            alt="product {{ $product->name }} {{ config('app.name') }}" />

                    </div>
                    <div class="relative">
                        <div id="carousel-detail-produk-{{ $product->id }}" class="relative w-full"
                            data-carousel="static">
                            <!-- Carousel wrapper -->
                            <div class="relative h-56 overflow-hidden rounded-lg md:h-56">
                                @foreach ($productGalleries as $gallery)
                                    <div class="hidden duration-700 ease-in-out" wire:ignore.self
                                        wire:key="{{ $gallery }}" data-carousel-item
                                        onclick="setThumbnail('{{ $gallery }}')">
                                        @php
                                            $image = $gallery;
                                        @endphp
                                        <div id="gallery-product-{{ $product->id }}"
                                            class=" p-2 cursor-pointer hover:scale-105 hover:shadow-2xl dark:bg-gray-800 w-full h-full absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                            style="background-image: url({{ $image }}); background-size: contain; background-position: center center; background-repeat: no-repeat;">
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Slider controls -->
                                <button type="button"
                                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                    data-carousel-prev>
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-800 rtl:rotate-180"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 1 1 5l4 4" />
                                        </svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </button>
                                <button type="button"
                                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                    data-carousel-next>
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-800 rtl:rotate-180"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span class="sr-only">Next</span>
                                    </span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <div class="flex flex-wrap justify-between items-center">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            {{ str()->upper($product->name) }}
                        </h1>
                        @php
                            $colors = ['red', 'blue', 'primary'];
                            $color = $colors[rand(0, count($colors) - 1)];
                            $class = sprintf(
                                'bg-%s-100 text-%s-800 text-lg font-bold me-2 px-2.5 py-0.5 rounded dark:bg-%s-900 dark:text-%s-300',
                                $color,
                                $color,
                                $color,
                                $color,
                            );
                        @endphp

                        <span class="{{ $class }}">
                            Kategori: {{ str()->ucfirst($product->category->name) }}
                        </span>
                    </div>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            {{ $product->formatRupiah() }}
                        </p>
                        @if ($ulasans->count() > 0)
                            <div class="flex items-center gap-2 mt-2 sm:mt-0">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                                    (5.0)
                                </p>
                                <a href="#"
                                    class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                                    345 Reviews
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="flex mb-4 justify-start gap-4 items-center mt-4">
                        <div>
                            <label for="color"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Warna</label>
                            <select id="color" wire:model="selectedColor"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @php
                                    $colors = explode(',', $product->color);
                                @endphp
                                @foreach ($colors as $color)
                                    <option value="{{ $color }}">{{ Str::ucfirst($color) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="size"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Ukuran</label>
                            <select id="size" wire:model="selectedSize"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @php
                                    $sizes = explode(',', $product->size);
                                @endphp
                                @foreach ($sizes as $size)
                                    <option value="{{ $size }}">{{ Str::ucfirst($size) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 pb-6 flex items-center gap-4">
                        <button type="button" wire:click="addToCart"
                            class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">

                            @svg('bx-loader-alt', [
                                'class' => 'w-5 h-5 -ms-2 me-2 animate-spin',
                                'wire:loading' => true,
                                'wire:target' => 'addToCart',
                            ])
                            @svg('heroicon-m-shopping-cart', [
                                'class' => 'w-5 h-5 -ms-2 me-2',
                                'wire:loading.remove' => true,
                                'wire:target' => 'addToCart',
                            ])
                            Keranjang
                        </button>

                        <button type="button" wire:click="buyNow"
                            class="text-white sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                            role="button">
                            @svg('bx-loader-alt', [
                                'class' => 'w-5 h-5 -ms-2 me-2 animate-spin',
                                'wire:loading' => true,
                                'wire:target' => 'buyNow',
                            ])
                            @svg('fas-money-check-dollar', [
                                'class' => 'w-5 h-5 -ms-2 me-2',
                                'wire:loading.remove' => true,
                                'wire:target' => 'buyNow',
                            ])

                            Beli Sekarang
                        </button>
                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
                </div>
            </div>
        </div>
    </section>

    {{-- deskripsi --}}
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Deskripsi Produk</h2>
                <div class=" max-w-2xl space-y-0 mt-8 dark:text-white">
                    {!! str($product->description)->sanitizeHtml() !!}
                </div>



            </div>
        </div>
    </section>
    {{-- end --}}

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Ulasan Produk</h2>
                    <div class="mt-6 sm:mt-0">
                        <label for="order-type"
                            class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select review
                            type</label>
                        <select id="order-type"
                            class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            <option selected>All reviews</option>
                            <option value="5">5 stars</option>
                            <option value="4">4 stars</option>
                            <option value="3">3 stars</option>
                            <option value="2">2 stars</option>
                            <option value="1">1 star</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6  sm:mt-8">
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @if ($ulasans->count() == null)
                            <div class="grid md:grid-cols-1 gap-4 md:gap-6 pb-4 md:pb-6">
                                <dl class="md:col-span-3 order-3 md:order-1">
                                    <dt class="sr-only">Product:</dt>
                                    <dd
                                        class="text-base font-semibold text-gray-900 dark:text-white p-4 bg-gray-100 rounded-lg">
                                        <span class="text-red-500 dark:text-red-500">Belum Ada Ulasan Pada Produk
                                            Ini</span>
                                    </dd>
                                </dl>



                            </div>
                        @else
                            @foreach ($ulasans as $ulasan)
                                <div class="grid md:grid-cols-1 gap-4 md:gap-6 pb-4 md:pb-6">
                                    <dl class="md:col-span-3 order-3 md:order-1">
                                        <dt class="sr-only">Product:</dt>
                                        <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                            <a href="#" class="hover:underline">Apple iMac 27", M2 Max CPU 1TB
                                                HDD,
                                                Retina
                                                5K </a>
                                        </dd>
                                    </dl>

                                    <dl class="md:col-span-6 order-4 md:order-2">
                                        <dt class="sr-only">Message:</dt>
                                        <dd class=" text-gray-500 dark:text-gray-400">It’s fancy, amazing keyboard,
                                            matching
                                            accessories. Super fast, batteries last more than usual, everything runs
                                            perfect in
                                            this...</dd>
                                    </dl>

                                    <div
                                        class="md:col-span-3 content-center order-1 md:order-3 flex items-center justify-between">
                                        <dl>
                                            <dt class="sr-only">Stars:</dt>
                                            <dd class="flex items-center space-x-1">
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                            </dd>
                                        </dl>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{ $ulasans->links() }}
            </div>
        </div>
    </section>
</div>
@push('js')
    <script>
        const preview = document.querySelector('#image-product-{{ $product->id }}');

        function setThumbnail(file) {
            if (file instanceof File) {
                // Buat URL dari file jika merupakan objek `File`
                preview.src = URL.createObjectURL(file);
            } else {
                // Jika `file` adalah URL, langsung gunakan
                preview.src = file;
            }
            // console.log(preview.src);
        }
    </script>
@endpush
