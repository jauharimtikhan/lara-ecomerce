{{-- @dd($products) --}}

<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Lacak Pesanan
            #{{ $data->transaction_id }}</h2>

        <div class="mt-6 sm:mt-8 lg:flex lg:gap-8">
            <div
                class="w-full divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200 dark:divide-gray-700 dark:border-gray-700 lg:max-w-xl xl:max-w-2xl">
                @foreach ($products as $product)
                    {{-- @dd($product['items']->toArray()['gambar_thumbnail']['path']) --}}
                    <div class="space-y-4 p-6">
                        <div class="flex items-center gap-6">
                            <a href="#" class="h-14 w-14 shrink-0">
                                <img class="h-full w-14 dark:hidden"
                                    src="{{ asset('storage/' . $product['items']->toArray()['gambar_thumbnail']['path']) }}"
                                    alt="produk {{ $product['items']->toArray()['name'] }}" />
                            </a>

                            <a href="#"
                                class="min-w-0 flex-1 font-medium text-gray-900 hover:underline dark:text-white">
                                {{ $product['items']->toArray()['name'] }}
                            </a>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400"><span
                                    class="font-medium text-gray-900 dark:text-white">ID Produk:</span>
                                {{ $product['items']->toArray()['id'] }}
                            </p>

                            <div class="flex items-center justify-end gap-4">
                                <p class="text-base font-normal text-gray-900 dark:text-white">x{{ $product['qty'] }}
                                </p>

                                <p class="text-xl font-bold leading-tight text-gray-900 dark:text-white">
                                    {{ 'Rp ' . number_format($product['price'] * $product['qty'], 2, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 grow sm:mt-8 lg:mt-0">
                <div
                    class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Riwayat Pesanan</h3>

                    <ol class="relative ms-3 border-s border-gray-200 dark:border-gray-700">
                        <li class="mb-10 ms-6">
                            <span
                                class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                </svg>
                            </span>
                            <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Estimated delivery
                                in 24 Nov 2023</h4>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Products delivered</p>
                        </li>

                        <li class="mb-10 ms-6">
                            <span
                                class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                </svg>
                            </span>
                            <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Today</h4>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Products being delivered
                            </p>
                        </li>

                        <li class="mb-10 ms-6 text-primary-700 dark:text-primary-500">
                            <span
                                class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-800">
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                            </span>
                            <h4 class="mb-0.5 font-semibold">23 Nov 2023, 15:15</h4>
                            <p class="text-sm">Products in the courier's warehouse</p>
                        </li>

                        <li class="mb-10 ms-6 text-primary-700 dark:text-primary-500">
                            <span
                                class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-800">
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                            </span>
                            <h4 class="mb-0.5 text-base font-semibold">22 Nov 2023, 12:27</h4>
                            <p class="text-sm">Products delivered to the courier - DHL Express</p>
                        </li>

                        <li class="mb-10 ms-6 text-primary-700 dark:text-primary-500">
                            <span
                                class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-800">
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                            </span>
                            <h4 class="mb-0.5 font-semibold">19 Nov 2023, 10:47</h4>
                            <p class="text-sm">Payment accepted - VISA Credit Card</p>
                        </li>

                        <li class="ms-6 text-primary-700 dark:text-primary-500">
                            <span
                                class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-800">
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                            </span>
                            <div>
                                <h4 class="mb-0.5 font-semibold">19 Nov 2023, 10:45</h4>
                                <a href="#" class="text-sm font-medium hover:underline">Order placed - Receipt
                                    #647563</a>
                            </div>
                        </li>
                    </ol>

                    <div class="gap-4 sm:flex sm:items-center">
                        <button type="button"
                            class="w-full rounded-lg  border border-gray-200 bg-white px-5  py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                            Batalkan Pesanan
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
