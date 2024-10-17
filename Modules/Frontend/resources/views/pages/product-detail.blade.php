<div>
    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased" data-aos="fade-right">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-1 md:grid md:grid-cols-2 md:gap-12">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img class="w-full rounded-lg drop-shadow-lg mb-5" loading="lazy"
                        src="{{ asset('storage/' . $product->thumbnail) }}"
                        alt="product {{ $product->name }} {{ config('app.name') }}" />

                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $product->name }}
                    </h1>
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

                    <p class="mb-6 text-gray-500 dark:text-gray-400">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- deskripsi --}}
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Product description</h2>
                <div class="my-8 xl:mb-16 xl:mt-12">
                    <img class="w-full dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-showcase.svg" alt="" />
                    <img class="hidden w-full dark:block"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-showcase-dark.svg"
                        alt="" />
                </div>
                <div class="mx-auto max-w-2xl space-y-6">
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">The iMac "M1" 8-Core CPU/8-Core
                        GPU/4 USB-C Shaped Ports (2021) model features a 5-nm Apple M1 processor with 8 cores (4
                        performance cores and 4 efficiency cores), an 8-core GPU, a 16-core Neural Engine, 8 GB of
                        onboard RAM, and a 1 TB onboard SSD.</p>

                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                        This all is housed in a wafer thin aluminum case with flat edges that includes a 23.5"
                        4480x2520, 218 PPI, LED-backlit, "True Tone" widescreen "Retina 4.5K" display mounted on a
                        svelte aluminum stand. This specific model is offered in the a two-tone Blue color. It also has
                        an integrated 1080p FaceTime HD camera, a "studio-quality three-mic array" and a "high-fidelity
                        six-speaker system" that supports Spatial Audio with Dolby Atmos.
                    </p>

                    <p class="text-base font-semibold text-gray-900 dark:text-white">Key Features and Benefits:</p>
                    <ul
                        class="list-outside list-disc space-y-4 pl-4 text-base font-normal text-gray-500 dark:text-gray-400">
                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> Brilliant 4.5K Retina display:
                            </span>
                            see the big picture and all the detailsSee it all in sharp, glorious detail on the immersive
                            24-inch 4.5K Retina display. The P3 wide color gamut brings what you're watching to life in
                            over a billion colors. Images shine with a brilliant 500 nits of brightness.
                            Industry-leading anti-reflective coating delivers greater comfort and readability. And True
                            Tone technology automatically adjusts the color temperature of your display to the ambient
                            light of your
                            environment, for a more natural viewing experience. So whether you're editing photos,
                            working on presentations, or watching your favorite shows and movies, everything looks
                            incredible on iMac.
                        </li>
                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> 1080p FaceTime HD camera: </span>
                            ready for your close-upIt's the best camera system ever in a Mac. Double the resolution for
                            higher-quality video calls. A larger sensor that captures more light. And the advanced image
                            signal processor (ISP) of M1 greatly improves image quality. So from collaborating with
                            coworkers to catching up with friends and family, you'll always look your best.
                        </li>

                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> Studio-quality mics for
                                high-quality conversations: </span>
                            whether you're on a video call with a friend, cutting a track, or recording a podcast, the
                            microphones on iMac make sure you come through loud, crisp, and clear. The studio-quality
                            three-mic array is designed to reduce feedback, so conversations flow more naturally and you
                            interrupt each other less. And beamforming technology helps the mics ignore background
                            noise. Which means everyone hears you - not what's going on around you.
                        </li>

                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> Six-speaker sound system: audio
                                that really fills a room: </span>
                            the sound system on iMac brings incredible, room-filling audio to any space. Two pairs of
                            force-canceling woofers create rich, deep bass without unwanted vibrations. And each pair is
                            balanced with a high-performance tweeter. The result is a massive, detailed soundstage that
                            takes your movies, music, and more to the next level.
                        </li>

                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> M1 chip: with great power comes
                                great capability: </span>
                            M1 is the most powerful chip Apple has ever made. macOS Big Sur is an advanced desktop
                            operating system. Combined, they take iMac to entirely new levels of performance,
                            efficiency, and security. iMac wakes from sleep almost instantly, apps launch in a flash,
                            and the whole system feels fluid, smooth, and snappy. With up to 85 percent faster CPU
                            performance and up to two times faster graphics performance than standard 21.5-inch iMac
                            models, you can use apps like
                            Xcode and Affinity Photo to compile code in a fraction of the time or edit photos in real
                            time. And it runs cool and quiet even while tackling these intense workloads. That's the
                            power of hardware, software, and silicon - all designed together.
                        </li>
                    </ul>
                </div>
                <div class="my-6 md:my-12">
                    <iframe class="h-[260px] md:h-[540px] w-full rounded-lg"
                        src="https://www.youtube.com/embed/KaLxCiilHns"
                        title="Flowbite Crash Course in 20 mins | Introduction to UI components using Tailwind CSS"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="mx-auto mb-6 max-w-3xl space-y-6 md:mb-12">
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Connectivity includes two
                        Thunderbolt / USB 4 ports and two USB 3 ports (all with a USB-C connector), a 3.5 mm headphone
                        jack conveniently mounted on the left edge of the display, Wi-Fi 6 (802.11ax), and Bluetooth
                        5.0.</p>

                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">A-Grade/CR: iMacs are in 9/10
                        Cosmetic Condition and are 100% Fully Functional. iMacs will be shipped in generic packaging and
                        will contain generic accessories. 90 Days Seller Warranty Included. iMacs may show signs of wear
                        like scratches, scuffs and minor dents.</p>
                </div>
                <div class="text-center">
                    <a href="#"
                        class="mb-2 mr-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Show
                        more...</a>
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
