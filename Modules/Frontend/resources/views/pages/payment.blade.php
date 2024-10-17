<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16" wire:ignore.self data-aos="fade-up"
    data-aos-duration="3000">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Pembayaran</h2>

            <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">


                <div id="skeleton-payment" class="max-w-xl w-full flex justify-center">
                    {{-- <dotlottie-player id="skeleton-lottie" src="{{ asset('frontend/icon/search_icon.json') }}"
                        background="transparent" speed="1" class="justify-center"
                        style="width: 300px; height: 300px;" loop autoplay></dotlottie-player> --}}
                </div>

                <div class="mt-6 grow sm:mt-8 lg:mt-0">
                    <div
                        class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total Harga</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ 'Rp. ' . number_format($items->pluck('sub_total')->sum(), 2, ',', '.') }}</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Biaya Ongkir</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ 'Rp. ' . number_format($items->pluck('grand_total')->first(), 2, ',', '.') }}
                                </dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Biaya Admin</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ 'Rp. ' . number_format(1000, 2, ',', '.') }}</dd>
                        </div>

                        <dl
                            class="flex items-center justify-between gap-4 border-t border-b border-gray-200 py-2 dark:border-gray-700">
                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                            @php
                                $recap =
                                    $items->pluck('sub_total')->sum() + $items->pluck('grand_total')->first() + 1000;
                                $total = 'Rp. ' . number_format($recap, 2, ',', '.');
                            @endphp
                            <dd class="text-base font-bold text-gray-900 dark:text-white">{{ $total }}</dd>
                        </dl>
                        <dl class="flex items-center">
                            <x-filament::button wire:click="payNow" type="button" color="primary" class="w-full">
                                Bayar Sekarang
                            </x-filament::button>
                        </dl>
                    </div>

                    <div class="mt-6 flex items-center flex-wrap justify-center gap-8">
                        <span class="dark:text-white">Pembayaran via</span>
                        <img src="{{ asset('frontend/img/logo-bank/midtrans.svg') }}" alt="" class="h-8 w-auto">
                    </div>
                </div>


            </div>
        </div>

</section>
@push('js')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endpush
@script
    <script>
        const modalPaymentId = `openModalPayment-{{ Auth::user()->id }}-{{ session()->getId() }}`;
        Livewire.on(modalPaymentId, () => {
            $wire.requestSnapToken().then((res) => {
                const skeletonPayment = document.getElementById('skeleton-lottie');
                const skeletonPaymentContainer = document.getElementById('skeleton-payment');
                skeletonPayment.remove();
                skeletonPaymentContainer.classList.add('rounded-lg');

                window.snap.embed(res, {
                    embedId: 'skeleton-payment',
                    onSuccess: function(result) {
                        console.log('success', result);
                    },
                    onPending: function(result) {
                        console.log('pending', result);
                        $wire.navigatedToRoute(result.transaction_id);
                    },
                    onError: function(result) {
                        console.log('error', result);
                    },
                    onClose: function(result) {
                        $wire.navigatedToRoute(result.transaction_id);
                    },
                })
            })


        })
    </script>
@endscript
