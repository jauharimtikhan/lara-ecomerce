@php
    $alertMessages = '';
@endphp
<section class="bg-white py-16 antialiased dark:bg-gray-900 md:py-16">
    <div class="flex items-center justify-center">
        @switch($status)
            @case('pending')
                <dotlottie-player src="https://lottie.host/2bdeab54-0b3d-4faa-a549-2af78411bb3b/FHMs5NT9DW.json"
                    background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></dotlottie-player>
            @break

            @case('settlement')
                <dotlottie-player src="https://lottie.host/c646d496-47b5-4a0d-95eb-78fb56aa955a/tN4JLfEGIZ.json"
                    background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></dotlottie-player>
            @break

            @case('error')
                <img src="{{ asset('frontend/icon/error.png') }}" alt="" class="w-20 h-20 ">
            @break

            @default
                <dotlottie-player src="https://lottie.host/2bdeab54-0b3d-4faa-a549-2af78411bb3b/FHMs5NT9DW.json"
                    background="transparent" speed="1" style="width: 200px; height: 200px;" loop
                    autoplay></dotlottie-player>
        @endswitch
    </div>

    <div class="mx-auto max-w-2xl px-4 2xl:px-0">

        @switch($status)
            @case('pending')
                @php
                    $alertMessages .=
                        'Mohon lakukan pembayaran sesuai dengan nominal yang tertera di atas. Untuk verifikasi pembayaran secara otomatis';
                @endphp
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">{{ ucfirst($status) }}</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Kode Invoice Anda <a href="#"
                        class="font-medium text-gray-900 dark:text-white hover:underline">
                        {{ $midtransData['order_id'] }}
                    </a>. Silahkan lakukan pembayaran sesuai dengan nominal yang tertera di bawah.
                </p>
                <div class="w-full my-6">
                    <div class="relative">
                        <label for="paymentDetailCopyButton-{{ session()->getId() }}" class="sr-only">Label</label>
                        <input id="paymentDetailCopyButton-{{ session()->getId() }}" type="text"
                            class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-center text-lg rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $midtransData['va_numbers'][0]['va_number'] }}" disabled readonly>
                        <button data-copy-to-clipboard-target="paymentDetailCopyButton-{{ session()->getId() }}"
                            data-tooltip-target="tooltip-copy-paymentDetailCopyButton-{{ session()->getId() }}"
                            class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center">
                            <span id="default-icon">
                                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 18 20">
                                    <path
                                        d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                                </svg>
                            </span>
                            <span id="success-icon" class="hidden inline-flex items-center">
                                <svg class="w-3.5 h-3.5 text-primary-700 dark:text-primary-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M1 5.917 5.724 10.5 15 1.5" />
                                </svg>
                            </span>
                        </button>
                        <div id="tooltip-copy-paymentDetailCopyButton-{{ session()->getId() }}" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            <span id="default-tooltip-message">Salin Nomor Virtual Akun</span>
                            <span id="success-tooltip-message" class="hidden">Copied!</span>
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
            @break

            @case('settlement')
                @php
                    $alertMessages .= '';
                @endphp
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">{{ ucfirst($status) }}</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Kode Invoice Anda <a href="#"
                        class="font-medium text-gray-900 dark:text-white hover:underline">
                        {{ $midtransData['order_id'] }}
                    </a> akan segera kami prosess dalam
                    24 jam setelah pembelian. Kami akan mengirimkan email konfirmasi.
                </p>
                {{-- <img src="{{ asset('frontend/icon/check.png') }}" alt="" class="w-20 h-20 "> --}}
            @break

            @case('error')
                {{-- <img src="{{ asset('frontend/icon/error.png') }}" alt="" class="w-20 h-20 "> --}}
            @break

            @default
                <div class="w-full my-6">
                    <div class="relative">
                        <label for="paymentDetailCopyButton-{{ session()->getId() }}" class="sr-only">Label</label>
                        <input id="paymentDetailCopyButton-{{ session()->getId() }}" type="text"
                            class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-center text-lg rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $midtransData['va_numbers'][0]['va_number'] }}" disabled readonly>
                        <button data-copy-to-clipboard-target="paymentDetailCopyButton-{{ session()->getId() }}"
                            data-tooltip-target="tooltip-copy-paymentDetailCopyButton-{{ session()->getId() }}"
                            class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center">
                            <span id="default-icon">
                                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 18 20">
                                    <path
                                        d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                                </svg>
                            </span>
                            <span id="success-icon" class="hidden inline-flex items-center">
                                <svg class="w-3.5 h-3.5 text-primary-700 dark:text-primary-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M1 5.917 5.724 10.5 15 1.5" />
                                </svg>
                            </span>
                        </button>
                        <div id="tooltip-copy-paymentDetailCopyButton-{{ session()->getId() }}" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            <span id="default-tooltip-message">Salin Nomor Virtual Akun</span>
                            <span id="success-tooltip-message" class="hidden">Copied!</span>
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
        @endswitch

        <div
            class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-2 md:mb-2">
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Tanggal Pembelian</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                    {{ $formatedDate }}
                </dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Metode Pembayaran</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                    @php
                        $paymentType = $midtransData['payment_type'];
                        $paymentType = str_replace('_', ' ', $paymentType);
                        $paymentType = ucfirst($paymentType);
                        $bankName = Str::upper($midtransData['va_numbers'][0]['bank']);
                        echo "{$paymentType} ({$bankName})";
                    @endphp
                </dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Total Pembelian</dt>
                <dd class="font-medium text-primary-900 underline dark:text-primary-600 sm:text-end">
                    @php
                        echo 'Rp. ' . number_format($midtransData['gross_amount'], 2, ',', '.');
                    @endphp
                </dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Alamat</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                    {{ $orders->address }}
                </dd>
            </dl>
        </div>
        <small class="text-sm  font-serif italic text-red-500 dark:text-red-500">
            *note: {{ $alertMessages }}
        </small>
        <div class="flex items-center space-x-4 mt-8">
            <x-filament::button color="primary" type="button" onclick="window.location.reload()">Cek
                Status</x-filament::button>
            <a href="{{ route('frontend.home') }}" wire:navigate
                class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Kembali
                Ke Beranda</a>
        </div>
    </div>
</section>
