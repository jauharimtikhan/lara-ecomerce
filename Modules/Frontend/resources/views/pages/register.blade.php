<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-10 h-10 mr-2" src="{{ asset('frontend/img/logo.png') }}" alt="logo">
            {{ config('app.name') }}
        </a>
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Buat Akun
                </h1>
                <form class="space-y-4 md:space-y-6" wire:submit="register">
                    <x-frontend-component::textinput type="text" name="username" placeholder="Username"
                        label="Username" />
                    <x-frontend-component::textinput type="email" name="email" placeholder="Email" label="Email" />
                    <x-frontend-component::textinput type="password" name="password" placeholder="••••••••"
                        label="Password" />
                    <x-frontend-component::textinput type="password" name="konfirmasi_password" placeholder="••••••••"
                        placeholder="••••••••" label="Konfirmasi Password" />
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
