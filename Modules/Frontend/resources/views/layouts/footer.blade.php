 {{-- Back To Top --}}
 <button id="backToTop" type="button"
     class="fixed bottom-4 right-4 z-50 hidden p-2 bg-primary-500 text-white rounded-full shadow-md transition-opacity hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50">
     @svg('fas-arrow-up', 'h-5 w-5')
 </button>

 {{-- End --}}

 {{-- Footer --}}
 <footer class="bg-white antialiased dark:bg-gray-800">
     <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
         <div class="border-b border-gray-100 py-6 dark:border-gray-700 md:py-8 lg:py-16">
             <div class="items-start gap-6 md:gap-8 lg:flex 2xl:gap-24">
                 <div class="max-w-xl space-y-5 dark:text-gray-200">
                     <p class="text-lg">Lara Ecomerce</p>
                     {!! str($footer->home_footer)->sanitizeHtml() !!}
                 </div>

             </div>
         </div>

         <div class="py-6 md:py-8">
             <div class="gap-4 space-y-5 xl:flex xl:items-center xl:justify-between xl:space-y-0">
                 <a href="#" title="Brand" class="flex items-center space-x-2">
                     <img class="block w-auto h-8 animate-bounce" src="{{ asset('frontend/img/logo.png') }}"
                         alt="">
                     <span class="dark:text-gray-200"> {{ config('app.name') }}</span>
                 </a>

                 <p class="text-sm text-gray-500 dark:text-gray-400">© {{ date('Y') }} <a href="#"
                         class="hover:underline">Jnologi</a>, Inc. All rights reserved.</p>
             </div>
         </div>
     </div>
 </footer>
 {{-- Footer end --}}
