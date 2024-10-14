<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
    <a href="#" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
        <img src="{{ asset('frontend/img/logo.png') }}" class="mr-4 h-11" alt="FlowBite Logo">
        <span>{{ config('app.name') }}</span>
    </a>
    <!-- Card -->
    <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <h2 class="text-xl text-center font-bold text-gray-900 dark:text-white">
            Silahkan Login Menggunakan Akun Anda
        </h2>
        <form class="mt-8 space-y-6" wire:submit="login">
            <x-frontend-component::textinput type="email" name="email" placeholder="Email" label="Email" />
            <x-frontend-component::textinput type="password" name="password" placeholder="••••••••" label="Password" />
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                        class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
                </div>
                <a href="#" class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">Lupa
                    Password?</a>
            </div>
            <x-frontend-component::button wire_target="login" wire_loading="true" type="submit" bg_color="primary"
                size="large">Login</x-frontend-component::button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                Belum Punya Akun? <a class="text-primary-700 hover:underline dark:text-primary-500">Buat Akun</a>
            </div>
        </form>
    </div>
</div>
