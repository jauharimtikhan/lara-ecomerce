<section class="bg-gray-50 dark:bg-gray-900 py-16">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-10 h-10 mr-2" src="{{ asset('frontend/img/logo.png') }}" alt="logo">
            {{ config('app.name') }}
        </a>
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Buat Akun
                </h1>
                <form class="space-y-4 md:space-y-6" wire:submit="register">
                    <div class="grid grid-cols-2 gap-4">
                        <x-frontend-component::textinput type="text" name="nama_lengkap" placeholder="Name Lengkap"
                            label="Nama Lengkap" />
                        <x-frontend-component::textinput type="tel" name="no_telp" placeholder="No Telepon"
                            label="No Telepon" />
                        <x-frontend-component::textinput type="text" name="username" placeholder="Username"
                            label="Username" />
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <div class="flex">
                                <input type="password" id="password" wire:model="password"
                                    class="rounded-none rounded-s-lg 
                                    bg-gray-50 border text-gray-900 focus:ring-primary-500 focus:border-primary-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="••••••••">
                                <span role="button" aria-selected="password"
                                    class="inline-flex items-center px-3 text-sm
                                    user-select-none text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300
                                    border-s-0 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600
                                    focus:border-primary-500 active:bg-gray-300  ">
                                    @svg('heroicon-c-eye', [
                                        'id' => 'password_toggle',
                                        'class' => 'w-4 h-4 text-gray-500 dark:text-gray-400',
                                    ])
                                </span>
                            </div>
                            @error('password')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <x-frontend-component::textinput type="email" name="email" placeholder="Email"
                            label="Email" />
                        <div>
                            <label for="konfirmasi_password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <div class="flex">
                                <input type="password" id="konfirmasi_password" wire:model="konfirmasi_password"
                                    class="rounded-none rounded-s-lg 
                                        bg-gray-50 border text-gray-900 focus:ring-primary-500 focus:border-primary-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="••••••••">
                                <span role="button"
                                    class="inline-flex items-center px-3 text-sm
                                         text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300 border-s-0 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    @svg('heroicon-c-eye', [
                                        'id' => 'konfirmasi_password_toggle',
                                        'class' => 'w-4 h-4 text-gray-500 dark:text-gray-400',
                                    ])
                                </span>
                            </div>
                            @error('konfirmasi_password')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-frontend-component::selectinput id="provinsi" name="provinsi" wire:model="provinsi"
                            label="Pilih Provinsi Anda">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->province_id }}">{{ $provinsi->province }}</option>
                            @endforeach
                        </x-frontend-component::selectinput>
                        <x-frontend-component::textinput type="text" name="kecamatan" placeholder="Kecamatan"
                            label="Kecamatan" />
                        <x-frontend-component::selectinput id="kabupaten" disabled name="kabupaten"
                            wire:model="kabupaten" label="Pilih Kabupaten/Kota Anda">
                            <option value="">Pilih Kabupaten</option>
                        </x-frontend-component::selectinput>
                        <x-frontend-component::textinput type="number" name="kodepos" placeholder="kodepos"
                            label="Kodepos" />
                    </div>
                    <div>
                        <label for="message"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Lengkap</label>
                        <textarea id="message" rows="4" wire:model="alamat_lengkap"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Contoh: Jl. Raya Pedurungan No. 1..."></textarea>
                        @error('alamat_lengkap')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" wire:model="terms" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">Saya setuju dengan
                                <a class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                                    href="#">Kebijakan Privasi</a></label>
                        </div>
                    </div>
                    @error('terms')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror


                    <x-frontend-component::button bg_color="primary" wire_loading="true" wire_target="register"
                        size="large" type="submit">Daftar</x-frontend-component::button>

                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Sudah punya akun? <a href="#"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@script
    <script>
        const prov = document.getElementById('provinsi');
        const kab = document.getElementById('kabupaten');

        prov.addEventListener('change', (e) => {
            $wire.getCities(e.target.value).then((cities) => {
                cities.forEach(item => {
                    const select = document.createElement('option');
                    select.value = item.city_id;
                    select.textContent = `${item.type} ${item.city_name}`;
                    kab.appendChild(select);
                    kab.removeAttribute('disabled');
                });
            })
        });

        const passCon = document.querySelector('#password');
        const passToggle = document.querySelector('#password_toggle');
        passToggle.addEventListener('click', (e) => {
            e.preventDefault();
            if (passCon.type === 'password') {
                passCon.type = 'text';
                passToggle.innerHTML = `@svg('heroicon-s-eye-slash', [
                    'class' => 'w-4 h-4 text-gray-500 dark:text-gray-400',
                    'id' => 'password_toggle',
                ])`;
            } else {
                passCon.type = 'password';
                passToggle.innerHTML = `@svg('heroicon-s-eye', [
                    'class' => 'w-4 h-4 text-gray-500 dark:text-gray-400',
                    'id' => 'password_toggle',
                ])`;
            }
        });

        const confmPassCon = document.querySelector('#konfirmasi_password');
        const confmPassToggle = document.querySelector('#konfirmasi_password_toggle');
        confmPassToggle.addEventListener('click', (e) => {
            e.preventDefault();
            if (confmPassCon.type === 'password') {
                confmPassCon.type = 'text';
                confmPassToggle.innerHTML = `@svg('heroicon-s-eye-slash', [
                    'class' => 'w-4 h-4 text-gray-500 dark:text-gray-400',
                    'id' => 'konfirmasi_password_toggle',
                ])`;
            } else {
                confmPassCon.type = 'password';
                confmPassToggle.innerHTML = `@svg('heroicon-s-eye', [
                    'class' => 'w-4 h-4 text-gray-500 dark:text-gray-400',
                    'id' => 'konfirmasi_password_toggle',
                ])`;
            }
        });
    </script>
@endscript
