@php
    $alertMessages = '';
    $statusMessage = '';
    $orderId = $midtransData['order_id'] ?? '';
    $vaNumber = $midtransData['va_numbers'][0]['va_number'] ?? '';
    $paymentType = ucfirst(str_replace('_', ' ', $midtransData['payment_type'] ?? ''));
    $bankName = Str::upper($midtransData['va_numbers'][0]['bank'] ?? '');
    $formattedTotal = 'Rp. ' . number_format($midtransData['gross_amount'] ?? 0, 2, ',', '.');
@endphp

<section class="bg-white py-16 antialiased dark:bg-gray-900 md:py-16"
    wire:poll.visible.3000ms="getMidtransData('{{ $order_id }}')">
    <div class="flex items-center justify-center">
        <dotlottie-player wire:replace key="{{ $status }}"
            src="
        @if ($status === 'pending') {{ asset('frontend/icon/lottie-pending.json') }}
                @elseif ($status === 'settlement')
                    {{ asset('frontend/icon/lottie-success.json') }}
                @elseif ($status === 'error')
                    {{ asset('frontend/icon/lottie-error.json') }}
                     @elseif ($status === 'expired')
                    {{ asset('frontend/icon/lottie-error.json') }}
                @else
                    {{ asset('frontend/icon/lottie-pending.json') }} @endif
        
        "
            background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></dotlottie-player>
    </div>

    <div class="mx-auto max-w-2xl px-4 2xl:px-0">
        @switch($status)
            @case('pending')
                @php
                    $alertMessages = 'Mohon lakukan pembayaran sesuai dengan nominal yang tertera di atas.';
                @endphp
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">{{ ucfirst($status) }}</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">
                    Kode Invoice Anda <a href="#"
                        class="font-medium text-gray-900 dark:text-white hover:underline">{{ $orderId }}</a>.
                    Silahkan lakukan pembayaran sesuai dengan nominal yang tertera di bawah.
                    <br><br>
                    <span class="dark:text-gray-400 py-4 px-4 bg-red-100 rounded-lg">
                        Lakukan pembayaran sebelum <i><span class="font-bold text-red-500">{{ $expiryTime }}</span></i>
                    </span>
                </p>
                <div class="w-full my-6 relative">
                    <input id="paymentDetailCopyButton" type="text"
                        class="bg-gray-50 border text-center text-lg rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600"
                        value="{{ $vaNumber }}" disabled readonly>
                    <button data-copy-to-clipboard-target="paymentDetailCopyButton"
                        class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 p-2 rounded-lg">
                        <span id="default-icon">
                            <!-- Icon SVG -->
                        </span>
                        <span id="success-icon" class="hidden">
                            <!-- Success Icon SVG -->
                        </span>
                    </button>
                    <div id="tooltip-copy-paymentDetailCopyButton"
                        class="absolute z-10 invisible px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 dark:bg-gray-700">
                        <span id="default-tooltip-message">Salin Nomor Virtual Akun</span>
                        <span id="success-tooltip-message" class="hidden">Copied!</span>
                    </div>
                </div>
            @break

            @case('settlement')
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Berhasil</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">
                    Kode Invoice Anda <a href="#"
                        class="font-medium text-gray-900 dark:text-white hover:underline">{{ $orderId }}</a> akan segera
                    kami proses dalam 24 jam setelah pembelian. Kami akan mengirimkan email konfirmasi.
                </p>
            @break

            @case('error')
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Error</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Terjadi kesalahan dalam pemrosesan pembayaran.</p>
            @break
        @endswitch

        <div class="space-y-4 sm:space-y-2 rounded-lg border bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-2">
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal text-gray-500 dark:text-gray-400">Tanggal Pembelian</dt>
                <dd class="font-medium text-gray-900 dark:text-white">{{ $formatedDate }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal text-gray-500 dark:text-gray-400">Metode Pembayaran</dt>
                <dd class="font-medium text-gray-900 dark:text-white">{{ $paymentType }} ({{ $bankName }})</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal text-gray-500 dark:text-gray-400">Total Pembelian</dt>
                <dd class="font-medium text-primary-900 underline dark:text-primary-600">{{ $formattedTotal }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal text-gray-500 dark:text-gray-400">Alamat</dt>
                <dd class="font-medium text-gray-900 dark:text-white">{{ $orders?->address }}</dd>
            </dl>
        </div>
        <small class="text-sm font-serif italic text-red-500 dark:text-red-500">*note: {{ $alertMessages }}</small>
        <div class="flex items-center space-x-4 mt-8">
            <x-filament::button color="primary" type="button">Cek Status</x-filament::button>
            <a href="{{ route('frontend.home') }}"
                class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Kembali
                Ke Beranda</a>
        </div>
    </div>
</section>
