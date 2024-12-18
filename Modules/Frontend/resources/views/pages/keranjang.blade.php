<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16" wire:ignore.self>
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0" data-aos="fade-up" wire:ignore.self data-aos-duration="3000">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang Belanja</h2>

        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl ">
                <div class="space-y-6">

                    @if (Cart::content()->count() > 0)

                        @foreach (Cart::instance('default')->content() as $item)
                            <div wire:key="{{ $item->id }}"
                                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <a href="{{ route('frontend.productdetail', [
                                        'id' => $item->options->product_id,
                                    ]) }}"
                                        class="shrink-0 md:order-1">
                                        <img class="h-20 w-20 rounded-lg"
                                            src="{{ asset('storage/' . $item->options->products['thumbnail']) }}"
                                            alt="product {{ $item->id }} {{ config('app.name') }}" />
                                    </a>

                                    <label for="counter-input" class="sr-only">Jumlah Barang:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <button wire:ignore type="button"
                                                id="decrement-button-{{ $item->options->product_id }}-{{ Auth::user()->id }}-{{ $item->id }}"
                                                data-input-counter-decrement="counter-input-{{ $item->options->product_id }}-{{ Auth::user()->id }}-{{ $item->id }}"
                                                wire:click="changeQuantity('{{ $item->rowId }}', 'decrease')"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                @svg('bx-loader-alt', [
                                                    'class' => 'h-2.5 w-2.5 text-gray-900 dark:text-white animate-spin',
                                                    'wire:loading' => true,
                                                    'wire:target' => "changeQuantity('{$item->rowId}', 'decrease')",
                                                ])
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    wire:loading.remove
                                                    wire:target="changeQuantity('{{ $item->rowId }}', 'decrease')"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text"
                                                id="counter-input-{{ $item->options->product_id }}-{{ Auth::user()->id }}-{{ $item->id }}"
                                                data-input-counter data-input-counter-min="1"
                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                placeholder="" value="{{ $item->qty }}" required />
                                            <button wire:ignore type="button"
                                                id="increment-button-{{ $item->options->product_id }}-{{ Auth::user()->id }}-{{ $item->id }}"
                                                data-input-counter-increment="counter-input-{{ $item->options->product_id }}-{{ Auth::user()->id }}-{{ $item->id }}"
                                                wire:click="changeQuantity('{{ $item->rowId }}', 'increase')"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                @svg('bx-loader-alt', [
                                                    'class' => 'h-2.5 w-2.5 text-gray-900 dark:text-white animate-spin',
                                                    'wire:loading' => true,
                                                    'wire:target' => "changeQuantity('{$item->rowId}', 'increase')",
                                                ])
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    wire:loading.remove
                                                    wire:target="changeQuantity('{{ $item->rowId }}', 'increase')"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>



                                        <div class="text-end md:order-4 md:w-32 flex items-center justify-end">
                                            <p class="text-base font-bold text-gray-900 dark:text-white flex-wrap">
                                                {{ 'Rp. ' . number_format($item->subtotal, 2, ',', '.') }}</p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <a href="#"
                                            class="text-base font-medium text-gray-900 overflow-hidden text-ellipsis hover:text-clip hover:underline dark:text-white">
                                            {{ ucfirst($item->name) }}
                                        </a>
                                        </a>

                                        <div class="flex items-center gap-4">
                                            <button type="button"
                                                wire:confirm="Apakah Anda Yakin Ingin Menghapus Item Ini?"
                                                wire:click="removeItem('{{ $item->rowId }}')"
                                                class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                @svg('bx-loader-alt', [
                                                    'class' => 'me-1.5 h-5 w-5 animate-spin',
                                                    'wire:loading' => true,
                                                    'wire:target' => "removeItem('{$item->rowId}')",
                                                ])
                                                <svg wire:loading.remove
                                                    wire:target="removeItem('{{ $item->rowId }}')"
                                                    class="me-1.5 h-5 w-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                                Hapus Barang
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <section class="bg-white dark:bg-gray-900">
                            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                                <div class="mx-auto max-w-screen-sm text-center">
                                    <h1
                                        class="animate-pulse mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                                        404</h1>
                                    <p
                                        class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                                        Wadooh</p>
                                    <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">
                                        Yah, keranjang anda masih kosong nih, yuk tambahkan produk

                                    </p>
                                    <a href="{{ route('frontend.home') }}"
                                        class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">
                                        Kembali Ke Beranda
                                    </a>
                                </div>
                            </div>
                        </section>
                    @endif

                </div>

            </div>

            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div
                    class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan Pembelian</p>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Sub Total</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ 'Rp. ' . Cart::subtotal(2) }}</dd>
                            </dl>
                            <dl class="grid grid-cols-2 items-center justify-between gap-2">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Ongkir</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white col-span-1 text-right">
                                    {{ 'Rp. ' . number_format($totalOngkir, 2, ',', '.') }}
                                </dd>
                                @if ($this->address != null)
                                    @isset($resultOngkirWhenUserDetailIsNotNull)
                                        <dt
                                            class="text-right col-span-2 text-base font-normal text-primary-500 dark:text-primary-400">
                                            <div
                                                class="w-full rounded-lg text-sm font-medium text-gray-900 bg-white flex flex-col flex-1 px-3 py-1 gap-y-2 border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                @foreach ($resultOngkirWhenUserDetailIsNotNull as $cost)
                                                    <button
                                                        wire:click="setOngkir('{{ $cost['service'] }}', '{{ $cost['cost'][0]['value'] }}', '{{ $cost['cost'][0]['etd'] }}', '{{ $cost['description'] }}')"
                                                        type="button"
                                                        class="w-full px-4 py-2 hover:bg-primary-600  font-medium flex items-center flex-wrap rounded-lg  text-truncate text-white bg-primary-700 border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600">
                                                        @svg('bx-loader-alt', [
                                                            'class' => 'text-white h-5 w-5 animate-spin',
                                                            'wire:loading' => true,
                                                            'wire:target' => "setOngkir('{$cost['service']}', '{$cost['cost'][0]['value']}', '{$cost['cost'][0]['etd']}', '{$cost['description']}')",
                                                        ])
                                                        <span class="dark:text-white font-medium" wire:loading.remove
                                                            wire:target="setOngkir('{{ $cost['service'] }}', '{{ $cost['cost'][0]['value'] }}', '{{ $cost['cost'][0]['etd'] }}', '{{ $cost['description'] }}')">
                                                            ({{ $cost['service'] }})
                                                            {{ $cost['description'] }} -
                                                            {{ 'Rp. ' . number_format($cost['cost'][0]['value'], 2, ',', '.') }}
                                                        </span>
                                                        <span class="dark:text-white" wire:loading.remove
                                                            wire:target="setOngkir('{{ $cost['service'] }}', '{{ $cost['cost'][0]['value'] }}', '{{ $cost['cost'][0]['etd'] }}', '{{ $cost['description'] }}')">
                                                            Estimasi {{ $cost['cost'][0]['etd'] }} Hari
                                                        </span>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </dt>
                                        <dt role="button" wire:click="openModalAddress"
                                            class="text-right col-span-2 text-base font-normal text-primary-500 dark:text-primary-400 hover:underline hover:cursor-pointer">
                                            @svg('bx-loader-alt', [
                                                'class' => 'me-1.5 h-5 w-5 animate-spin',
                                                'wire:loading' => true,
                                                'wire:target' => 'openModalAddress',
                                            ])
                                            <span wire:loading.remove wire:target="openModalAddress">
                                                Ubah Alamat Pengiriman
                                            </span>
                                        </dt>
                                    @endisset
                                @else
                                    <dt role="button" wire:click="openModalAddress"
                                        class="text-right col-span-2 text-base font-normal text-primary-500 dark:text-primary-400 hover:underline hover:cursor-pointer">
                                        @svg('bx-loader-alt', [
                                            'class' => 'me-1.5 h-5 w-5 animate-spin',
                                            'wire:loading' => true,
                                            'wire:target' => 'openModalAddress',
                                        ])
                                        <span wire:loading.remove wire:target="openModalAddress">
                                            Alamat Pengiriman
                                        </span>
                                    </dt>
                                @endif
                                <dd>
                                <dt role="button" data-dropdown-offset-skidding="30"
                                    data-dropdown-toggle="notes-seller-dropdown-{{ Auth::user()->id }}-{{ session()->getId() }}"
                                    class="text-right col-span-2 text-base font-normal text-gray-500 dark:text-gray-400 hover:underline hover:cursor-pointer">
                                    <div class="flex items-center justify-end">

                                        @svg('bxs-message-detail', [
                                            'class' => 'me-1.5 h-5 w-5',
                                        ])
                                        <span class="dark:text-white">
                                            Pesan Kepenjual
                                        </span>
                                    </div>
                                </dt>
                                <div wire:ignore.self
                                    id="notes-seller-dropdown-{{ Auth::user()->id }}-{{ session()->getId() }}"
                                    class="z-10 w-80 px-4 py-6 bg-gray-50 hidden divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-white" aria-labelledby="dropdownDefaultButton">
                                        <li class="flex flex-col items-center w-full gap-4">
                                            <textarea wire:model.defer="notes" rows="8"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Tulis catatan..."></textarea>

                                            <x-filament::button wire:click="setNotes"
                                                class="flex flex-wrap items-center justify-center w-full">


                                                <span class="dark:text-white " wire:loading.remove
                                                    wire:target="setNotes">Kirim</span>
                                            </x-filament::button>
                                        </li>
                                    </ul>
                                </div>
                                </dd>
                            </dl>
                        </div>
                        @php
                            $total = '';
                            $subtotal = Cart::subtotal(0, '', ''); // Mengambil subtotal tanpa format
                            $totalOngkir = intval($totalOngkir);

                            if ($totalOngkir > 0) {
                                $recap = $subtotal + $totalOngkir;
                                $total = 'Rp. ' . number_format($recap, 2, ',', '.'); // 0 desimal, karena biasanya harga dalam Rupiah tidak memerlukan desimal
                            } else {
                                $total = 'Rp. 0';
                            }
                        @endphp
                        <dl
                            class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd class="text-base font-bold text-gray-900 dark:text-white">
                                {{ $total }}
                            </dd>
                        </dl>
                    </div>

                    <button type="button" wire:click="checkout"
                        class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        @svg('bx-loader-alt', [
                            'class' => 'me-1.5 h-5 w-5 animate-spin',
                            'wire:loading' => true,
                            'wire:target' => 'checkout',
                        ])
                        Checkout Sekarang
                    </button>

                    <div class="flex items-center justify-center gap-2">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> atau </span>
                        <a href="{{ route('frontend.home') }}" wire:navigate
                            class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                            Kembali Ke Beranda
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
                @if (Cart::discount() > 0)
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <form class="space-y-4">
                            <div>
                                <label for="voucher"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Kode voucher?
                                </label>
                                <input type="text" id="kodeVoucher"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="" />
                            </div>
                            <button type="submit"
                                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Gunakan Voucher
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <!-- Main modal -->
    <div id="modalcekongkir-{{ Auth::user()->id }}-{{ session()->getId() }}-{{ $wire }}" wire:ignore
        tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[600] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Cek Harga Ongkir Pengiriman
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modalcekongkir-{{ Auth::user()->id }}-{{ session()->getId() }}-{{ $wire }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4">
                        <div class="grid grid-cols-2 gap-4 md:grid-cols-1">
                            <div>
                                <label for="provinsi-{{ Auth::user()->id }}-{{ session()->getId() }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Provinsi
                                </label>
                                <select id="provinsi-{{ Auth::user()->id }}-{{ session()->getId() }}"
                                    wire:model="dataOngkir.provinsi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" hidden wire:loading.remove wire:target="loadProvincies">
                                        Pilih Provinsi</option>
                                    <option value="" hidden wire:loading wire:target="loadProvincies">Loading...
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="kabupaten-{{ Auth::user()->id }}-{{ session()->getId() }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    <span wire:loading.remove wire:target="loadCities">Kabupaten</span>
                                    <span wire:loading wire:target="loadCities">Loading...</span>
                                </label>
                                <select id="kabupaten-{{ Auth::user()->id }}-{{ session()->getId() }}"
                                    wire:model="dataOngkir.kabupaten"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" hidden wire:loading.remove wire:target="loadCities">Pilih
                                        Kabupaten</option>
                                    <option value="" hidden wire:loading wire:target="loadCities">Silahkan
                                        Memilih Provinsi Dulu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <div role="status"
                                    class="animate-pulse p-4 bg-gray-400 dark:bg-gray-700 w-full rounded-lg h-5"
                                    wire:loading wire:target="cekOngkirAction"></div>
                                <div id="result-ongkir-{{ Auth::user()->id }}-{{ session()->getId() }}"
                                    class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>

                            </div>
                        </div>
                        <div class="flex justify-end">
                            <x-filament::button wire:target="cekOngkirAction" type="button" color="primary"
                                id="cekongkirButton-{{ Auth::user()->id }}-{{ session()->getId() }}">Cek
                                Biaya Ongkir</x-filament::button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @livewire('frontend-sub-component::modaladdress')

</section>
@script
    <script>
        const modalCekOngkir = `modalcekongkir-{{ Auth::user()->id }}-{{ session()->getId() }}-{{ $wire }}`;
        Object.assign(window.PageProps, {
            keranjang: {
                idModalCekOngkir: modalCekOngkir,
                userDetail: @json($address)
            },

        });

        const propsKeranjang = window.PageProps;
        const options = {
            placement: "center",
            backdrop: "dynamic",
            backdropClasses: "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40",
            closable: true,
            onHide: () => {
                let resultOngkir = document.getElementById(
                    "result-ongkir-{{ Auth::user()->id }}-{{ session()->getId() }}"
                );
                let provinsi = document.getElementById(
                    "provinsi-{{ Auth::user()->id }}-{{ session()->getId() }}"
                );
                let kabupaten = document.getElementById(
                    "kabupaten-{{ Auth::user()->id }}-{{ session()->getId() }}"
                );
                provinsi.innerHTML = "";
                kabupaten.innerHTML = "";
                resultOngkir.innerHTML = "";
            },
            onShow: () => {
                let provinsi = document.getElementById(
                    `provinsi-${propsKeranjang.user.id}-${propsKeranjang.session}`
                );
                let kabupaten = document.getElementById(
                    `kabupaten-${propsKeranjang.user.id}-${propsKeranjang.session}`
                );
                $wire.loadProvincies().then((res) => {
                    res.forEach((prov) => {
                        let selected = '';
                        if (prov.province_id == propsKeranjang.keranjang.userDetail.provinsi) {
                            selected = 'selected';
                        } else {
                            selected = '';
                        }
                        provinsi.innerHTML +=
                            `<option ${selected} value="${prov.province_id}" data-name="${prov.province}">${prov.province}</option>`;
                        if (propsKeranjang.keranjang.userDetail.provinsi == null) {
                            provinsi.addEventListener("change", (e) => {

                                let selectedOption =
                                    e.target.options[e.target.selectedIndex];
                                let provinceName = selectedOption.dataset.name;

                                $wire.dataAlamat.provinsi = provinceName;

                                $wire.loadCities(propsKeranjang.keranjang.userDetail
                                        .provinsi)
                                    .then((res) => {
                                        res.forEach((prov) => {
                                            let selected = '';
                                            if (prov.city_id == propsKeranjang
                                                .keranjang
                                                .userDetail.kabupaten) {
                                                selected = 'selected';
                                            } else {
                                                selected = '';
                                            }
                                            kabupaten.innerHTML +=
                                                `<option ${selected} value="${prov.city_id}">${prov.city_name}</option>`;
                                        });
                                    });
                            });
                        }
                    });


                });

                const cekongkirButton = document.getElementById(
                    `cekongkirButton-${propsKeranjang.user.id}-${propsKeranjang.session}`
                );
                cekongkirButton.addEventListener("click", () => {
                    $wire.cekOngkirAction(propsKeranjang.keranjang.userDetail.kabupaten).then((res) => {
                        let resultOngkir = document.getElementById(
                            `result-ongkir-${propsKeranjang.user.id}-${propsKeranjang.session}`
                        );
                        res.costs.forEach((res) => {
                            const dataParam = {
                                service: res.service,
                                cost: res.cost[0].value,
                                estimate: res.cost[0].etd,
                                description: res.description,
                            };
                            resultOngkir.innerHTML += `
                            <button type="button" wire:click="setOngkir('${dataParam.service}', '${dataParam.cost}', '${dataParam.estimate}', '${dataParam.description}')"
                            class="block w-full px-4 py-2 border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-700 focus:text-primary-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                            (${dataParam.service}) ${dataParam.description} - Rp. ${dataParam.cost} - ${dataParam.estimate} Hari
                            </button>
                        `;
                        });
                    });
                });
            },
            onToggle: () => {
                console.log("modal has been toggled");
            },
        };

        const instanceOptions = {
            id: propsKeranjang.keranjang.idModalCekOngkir,
            override: true,
        };
        const modalBackdropCekOngkir = new Modal(
            document.getElementById(propsKeranjang.keranjang.idModalCekOngkir),
            options,
            instanceOptions
        );

        const optionsAddress = {
            placement: "center",
            backdrop: "static",
            backdropClasses: "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40",
            closable: true,
            onHide: () => {
                window.location.reload();
            },
            onShow: () => {
                //
            },
            onToggle: () => {
                // console.log("modal has been toggled");
            },
        };

        const instanceOptionsAddress = {
            id: `modal-address-{{ Auth::user()->id }}`,
            override: true,
        };

        const modalBackdropAddress = new Modal(
            document.getElementById(`modal-address-{{ Auth::user()->id }}`),
            optionsAddress,
            instanceOptionsAddress);

        const closeModalAddressButton = document.getElementById(`close-modal-address-{{ Auth::user()->id }}`);

        closeModalAddressButton.addEventListener("click", () => {
            modalBackdropAddress.hide();
        });

        Livewire.on("openModalCekongkir", () => {
            modalBackdropCekOngkir.show();
        });

        Livewire.on('openModalAddress', () => {
            modalBackdropAddress.show();
        })

        Livewire.on("updatedOngkir", () => {
            modalBackdropCekOngkir.hide();
            let resultOngkir = document.getElementById(
                "result-ongkir-{{ Auth::user()->id }}-{{ session()->getId() }}"
            );
            let provinsi = document.getElementById(
                "provinsi-{{ Auth::user()->id }}-{{ session()->getId() }}"
            );
            let kabupaten = document.getElementById(
                "kabupaten-{{ Auth::user()->id }}-{{ session()->getId() }}"
            );
            provinsi.innerHTML = "";
            kabupaten.innerHTML = "";
            resultOngkir.innerHTML = "";
        });

        Livewire.on('redirectOnPaymentIsNotNull', (e) => {
            ;

            setTimeout(() => {
                window.location.replace(e[0].url);
            }, e[0].delay);
        })
    </script>
@endscript
