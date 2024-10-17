<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 h-screen">
        <div class="flex items-center justify-center md:max-w-sm sm:max-w-sm md:mt-8">
            <dotlottie-player src="{{ asset('frontend/icon/lara_logo.json') }}" background="transparent" speed="1"
                class="mb-28 mx-auto max-w-md absolute translate-x-[-9%]" loop autoplay>
            </dotlottie-player>
        </div>

        <div
            class="w-full z-10 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Silahkan Login
                </h1>
                <form class="space-y-4 md:space-y-6" wire:submit="login">
                    <x-frontend-component::textinput type="email" name="email" placeholder="Email" label="Email" />
                    <x-frontend-component::textinput type="password" name="password" placeholder="••••••••"
                        label="Password" />
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                            </div>
                        </div>
                        <a href="#"
                            class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Lupa
                            Password?</a>
                    </div>
                    <x-frontend-component::button type="submit" bg_color="primary" wire_loading="true"
                        wire_target="login" size="large">Login</x-frontend-component::button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Belum punya akun? <a href="{{ route('frontend.register') }}"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Daftar</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
