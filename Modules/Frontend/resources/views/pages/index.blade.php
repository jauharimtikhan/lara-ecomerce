<div class="dark:bg-gray-900">

    {{-- Hero Start --}}
    <section class="bg-white md:py-16 max-w-screen-xl antialiased dark:bg-gray-900  mx-auto">
        <div class="z-[10] relative dark:bg-gray-900 pb-8 px-6 rounded-lg">
            <div id="controls-carousel" class="relative w-full  dark:bg-gray-900" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 md:h-[30rem] overflow-hidden dark:bg-gray-900 rounded-lg ">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('frontend/img/Content_1.png') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <img src="{{ asset('frontend/img/Content_2.png') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('frontend/img/Content_3.png') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>

                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 h-full start-0 z-30 flex items-center justify-center  px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 h-full end-0  z-30 flex items-center justify-center  px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
        <div
            class="mx-auto grid max-w-screen-xl grid-cols-2 gap-8 text-gray-500 dark:text-gray-400 sm:grid-cols-3 sm:gap-12 lg:grid-cols-6 px-4">

            <a href="#" class="flex items-center md:justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 hover:text-gray-900 dark:hover:text-white"
                    viewBox="0 0 192.756 200">
                    <g fill-rule="evenodd" clip-rule="evenodd">
                        <path fill="currentColor" fill-opacity="0" d="M0 0h192.756v192.756H0V0z" />
                        <path fill="currentColor"
                            d="M8.504 37.451h18.639l10.328 71.031 10.075-71.031h127.706l-4.281 20.403H63.164l-16.373 93.449h-18.64L8.504 37.451z" />
                        <path fill="currentColor"
                            d="M178.527 124.855c.504 11.082-5.793 27.959-19.648 27.959-16.119 0-19.646-19.898-19.646-28.211h13.098c0 4.785 4.031 9.572 7.053 9.572 3.023 0 6.047-3.779 6.047-6.297 0-2.52-1.008-6.297-5.793-9.572-15.619-9.32-19.145-20.152-19.145-29.471-.504-11.083 4.785-27.456 18.639-27.456 13.855 0 17.633 19.396 17.633 27.456h-12.342c0-4.534-3.023-7.808-6.045-7.808-3.023 0-5.039 3.022-5.039 5.542 0 2.519.504 4.786 5.291 8.06 6.548 3.023 19.897 12.846 19.897 30.226zM179.275 146.266a4.031 4.031 0 0 1 4.037 4.037 4.036 4.036 0 0 1-4.037 4.062 4.05 4.05 0 0 1-4.062-4.062c0-2.235 1.816-4.037 4.062-4.037v-.939c-2.768 0-5.002 2.234-5.002 4.977a4.995 4.995 0 0 0 5.002 5.002c2.742 0 4.977-2.234 4.977-5.002a4.985 4.985 0 0 0-4.977-4.977v.939z" />
                        <path fill="currentColor"
                            d="M178.273 148.438h1.307c.521 0 1.283 0 1.283.697 0 .686-.42.826-1.016.812h-1.574v.801h1.053l1.193 2.285h1.232l-1.309-2.285c.953-.064 1.473-.471 1.473-1.447 0-.559-.152-1.08-.635-1.396-.406-.254-1.002-.268-1.459-.268h-2.604v5.396h1.055v-4.595h.001zM69.712 121.078l5.038-32.746 5.038 32.746H69.712zm-3.022 18.387h15.617l2.015 11.838h24.936v-46.85l15.365 46.85h12.846V64.151h-13.098v44.332l-14.609-44.332H96.161v81.863L82.055 64.151h-14.61l-15.113 87.152h12.846l1.512-11.838z" />
                    </g>
                </svg>

            </a>
            <a href="#" class="flex items-center md:justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-25 h-21 hover:text-gray-900 dark:hover:text-white"
                    viewBox="0 0 192.756 200">
                    <g fill-rule="evenodd" clip-rule="evenodd">
                        <path fill="currentColor" fill-opacity="0" d="M0 0h192.756v192.756H0V0z" />
                        <path fill="currentColor"
                            d="M110.547 47.595l1.092 2.215c3.367.303 6.582 1.031 9.404 2.609 2.062 1.122 3.943 2.699 6.188 3.397.031.212 0 .516.031.759l.576.06 9.857 7.766c1.852 1.76 3.703 3.458 5.826 4.611v.88l.697.061c4.367 3.033 9.312 5.49 15.016 4.429 3.215-.637 6.309-3.337 7.705-6.34l4.975-10.981c1.699-3.458 5.188-6.734 8.494-8.797 1.152-.577 2.76-1.183 4.064-.425 1.062.697 1.516 1.851 1.486 3.125-.152 1.972-1.668 3.913-3.52 4.641-2.426 1.396-5.125 2.093-7.25 4.187-1 1.638-2.607 3.003-3.396 4.671-1.152 2.335-1.941 4.823-3.004 7.219h-.303l-.941 1.972c-1.305 1.76-3.031 3.458-4.854 4.459l-.182.546c2.428 3.701 3.246 8.1 3.914 12.528.09 2.245-.395 4.763.424 6.764.182.455.486.881.729 1.365v.76l3.033 2.396c.789 3.033 2.699 5.732 2.246 9.16-.457 1.518-.486 3.277-.213 4.854-.334.486-1.094.213-1.609.213-1.668-.213-3.67-1.184-4.064-3.004-.273-2.518-.242-5.125-.424-7.674l-6.037-5.279c-1.486-1.729-2.365-3.699-3.943-5.399l-.971-1.638-3.883-8.949a8.614 8.614 0 0 0-6.127-3.852l-8.555-.789c-3.428-.789-6.553-2.306-9.525-4.186-2.365-1.699-4.367-4.248-6.703-6.006h-.971c-1.73 1.911-4.035 2.548-6.584 2.245-3.73-.243-6.611-2.518-10.191-3.155-.305.667-.455 1.456-.697 2.184-1.336.152-3.096.546-4.064-.667-.82-.88-.973-2.214-.639-3.367.971-2.366 3.52-3.337 5.916-3.428 1.91-.091 3.641.333 5.521.273l.271-.182-.334-1.911-1.395-1.273-3.912.333-3.883-2.851-.668-.85v-1.456l1.607-1.911.789-1.851 2.668-2.305 1.244-2.214c.91-.304 1.518.394 2.186.728l.939-.243 1.002-1.123h.91l.032.696zM35.166 91.947c1.79.212 3.913.573 4.581 2.515l.182.91v23.175c-.122 1.881-.667 3.943-2.609 4.703-.971.363-2.033.545-3.125.576H23.623v10.162H11.414V91.947h23.752zM55.384 117.061l-.212 1.912v7.645c0 .766.318 1.516 1.046 1.881.607.211 1.364.09 1.88-.244.698-.545.85-1.363.85-2.215V91.947h11.724v14.952l-.318 2.094-.03 20.264c-.152 1.578-.365 3.307-1.942 4.094-1.244.547-2.669.668-4.156.639l-16.047-.031c-1.517-.182-3.186-.273-4.095-1.699-.698-1.213-.789-2.699-.85-4.186V91.947h12.149v25.114h.001zM112.004 91.947c1.758.151 3.639 1.241 4.125 3 .424 1.334.424 3.186 0 4.52l.029 8.584.244 1.639v24.299h-11.771v-21.842l.305-1.092-.031-10.102c-.15-.818-.363-1.639-.303-2.549-.121-.484-.516-.908-.971-1.09-.607-.273-1.396-.123-1.912.242-.91.666-.455 2.002-.576 3.033l-.334.545.031 11.801.303 1.092v19.961H89.464l.031-15.289.333-1.457v-14.316l-.364-.881-.03-3.67c-.121-.576-.637-1.092-1.183-1.213-.698 0-1.456.061-1.941.576-.395.455-.303 1.092-.303 1.699-.03 1.426.091 2.912-.333 4.154l.03 16.625.303 1.455v12.316H74.54l-.03-27.514-.272-1.486.03-9.98c.122-1.274 1.366-2.366 2.518-2.669.728-.213 1.456-.361 2.214-.392h33.004v.001z" />
                        <<path fill="currentColor"
                            d="M142.338 91.947c1.547.212 3.215.513 4.004 2.03l.182.849c0 2.413-.121 5.444.334 7.401v31.762h-11.74v-10.133h-3.123v10.133h-12.148v-25.057l.242-1.092v-8.646c-.455-1.273-.197-2.852-.229-4.247.547-1.577 2.199-3 3.883-3h18.595z" />
                        <<path fill="currentColor"
                            d="M27.248 97.525c.304.576.425 1.213.425 1.912l-.03 16.805c-.091.758-.425 1.576-1.183 1.971-.789.455-1.865.395-2.836.395V96.494c1.334-.152 2.896-.242 3.624 1.031zM135.27 98.012l.213.484c0 2.305.15 5.15-.365 6.855v13.227h-3.123v-12.467l-.531-1.609V98.83c0-.721.773-1.365 1.471-1.607.848-.274 1.819.029 2.335.789zM49.509 132.906a.531.531 0 0 0 .531-.531v-6.623a.53.53 0 1 0-1.062 0v6.623a.53.53 0 0 0 .531.531zM47.36 132.906a.531.531 0 0 0 .531-.531v-2.527a.531.531 0 0 0-1.062 0v2.527c0 .293.238.531.531.531zM55.854 132.906a.531.531 0 0 0 .531-.531v-2.527a.531.531 0 0 0-1.062 0v2.527c0 .293.238.531.531.531zM58.281 132.906a.53.53 0 0 0 .53-.531v-2.527a.53.53 0 1 0-1.061 0v2.527a.53.53 0 0 0 .531.531zM51.556 132.906a.531.531 0 0 0 .531-.531v-9.596a.53.53 0 1 0-1.062 0v9.596c0 .293.238.531.531.531zM53.528 132.906a.531.531 0 0 0 .531-.531v-12.842a.531.531 0 0 0-1.062 0v12.842c0 .293.238.531.531.531zM60.657 132.906a.531.531 0 0 0 .531-.531v-12.842a.531.531 0 0 0-1.062 0v12.842a.53.53 0 0 0 .531.531zM62.729 132.906a.531.531 0 0 0 .531-.531v-19.121a.53.53 0 1 0-1.062 0v19.121a.532.532 0 0 0 .531.531zM64.701 132.906a.531.531 0 0 0 .531-.531v-20.121a.53.53 0 1 0-1.062 0v20.121c0 .293.238.531.531.531zM66.673 132.906a.53.53 0 0 0 .53-.531v-21.438a.53.53 0 1 0-1.061 0v21.438c0 .293.238.531.531.531zM68.645 132.906a.53.53 0 0 0 .53-.531v-22.336a.53.53 0 1 0-1.061 0v22.336c0 .293.238.531.531.531zM75.962 132.906a.532.532 0 0 0 .532-.531v-26.068a.53.53 0 0 0-1.062 0v26.068c0 .293.238.531.53.531zM77.998 132.906a.53.53 0 0 0 .531-.531v-26.594a.53.53 0 1 0-1.061 0v26.594a.53.53 0 0 0 .53.531zM80.033 132.906a.531.531 0 0 0 .531-.531v-27.16a.531.531 0 0 0-1.062 0v27.16c0 .293.238.531.531.531zM82.068 123.289a.53.53 0 0 0 .531-.529v-18.061a.531.531 0 0 0-1.062 0v18.061a.53.53 0 0 0 .531.529zM84.103 121.701a.53.53 0 0 0 .531-.529v-16.715a.531.531 0 0 0-1.062 0v16.715a.53.53 0 0 0 .531.529zM91.181 117.266a.531.531 0 0 0 .531-.531v-13.49a.531.531 0 0 0-1.062 0v13.49c0 .292.238.531.531.531zM93.216 116.658a.53.53 0 0 0 .531-.529V102.94a.53.53 0 0 0-.531-.529.53.53 0 0 0-.531.529v13.189a.53.53 0 0 0 .531.529zM95.251 115.748c.293 0 .53-.236.53-.529v-12.885a.53.53 0 1 0-1.061 0v12.885a.53.53 0 0 0 .531.529zM97.285 114.838a.529.529 0 0 0 .531-.531V102.03a.53.53 0 1 0-1.061 0v12.277a.53.53 0 0 0 .53.531zM99.32 113.928a.53.53 0 0 0 .531-.529v-11.672a.531.531 0 0 0-1.062 0v11.672a.53.53 0 0 0 .531.529zM106.412 111.4a.53.53 0 0 0 .529-.531v-10.053a.53.53 0 1 0-1.06 0v10.053c0 .293.238.531.531.531zM108.535 111.098a.531.531 0 0 0 .531-.531v-10.053a.531.531 0 0 0-1.062 0v10.053c0 .292.238.531.531.531zM110.658 110.49a.531.531 0 0 0 .531-.531v-9.748a.531.531 0 0 0-1.062 0v9.748c0 .293.238.531.531.531zM112.781 109.883a.53.53 0 0 0 .531-.531v-9.445c0-.293-.238-.529-.531-.529s-.531.236-.531.529v9.445a.53.53 0 0 0 .531.531zM114.906 109.277a.53.53 0 0 0 .529-.531v-9.445a.53.53 0 1 0-1.06 0v9.445a.53.53 0 0 0 .531.531zM121.719 107.76a.528.528 0 0 0 .529-.531v-7.928a.53.53 0 1 0-1.06 0v7.928a.53.53 0 0 0 .531.531zM123.701 107.152a.528.528 0 0 0 .531-.529v-7.627a.528.528 0 0 0-.531-.529.528.528 0 0 0-.529.529v7.627c0 .293.236.529.529.529zM125.686 106.547a.53.53 0 0 0 .531-.531v-7.322a.53.53 0 1 0-1.06 0v7.322a.529.529 0 0 0 .529.531zM127.67 105.939a.529.529 0 0 0 .531-.531V98.39a.53.53 0 1 0-1.06 0v7.018c0 .295.236.531.529.531zM129.654 105.637a.53.53 0 0 0 .531-.531v-7.02a.53.53 0 1 0-1.06 0v7.02c0 .292.238.531.529.531zM137.121 103.684a.53.53 0 0 0 .529-.531V97.48a.53.53 0 1 0-1.06 0v5.672a.53.53 0 0 0 .531.532zM139.123 103.107a.53.53 0 0 0 .529-.531v-5.4a.528.528 0 0 0-.529-.529.528.528 0 0 0-.531.529v5.4a.53.53 0 0 0 .531.531zM141.125 102.5a.53.53 0 0 0 .529-.531v-5.096a.53.53 0 1 0-1.06 0v5.096a.53.53 0 0 0 .531.531zM143.125 102.045a.529.529 0 0 0 .531-.531V96.57a.53.53 0 1 0-1.06 0v4.943a.53.53 0 0 0 .529.532zM145.129 101.105a.531.531 0 0 0 .531-.531v-4.308a.531.531 0 0 0-1.062 0v4.308c0 .293.238.531.531.531z"
                            fill="#fff" />
                        <<path fill="currentColor"
                            d="M158.449 127.363c.752.768 1.129 1.674 1.129 2.719 0 1.074-.379 1.996-1.135 2.766-.756.764-1.666 1.145-2.732 1.145a3.719 3.719 0 0 1-2.738-1.139c-.76-.76-1.141-1.684-1.141-2.771 0-1.049.373-1.955 1.121-2.719.76-.781 1.68-1.172 2.758-1.172 1.066-.001 1.978.39 2.738 1.171zm.58-.599c-.916-.916-2.023-1.375-3.318-1.375-1.234 0-2.312.424-3.229 1.273-.977.908-1.465 2.049-1.465 3.42 0 1.32.451 2.434 1.355 3.338s2.018 1.357 3.338 1.357c1.277 0 2.373-.441 3.287-1.326.938-.912 1.408-2.035 1.408-3.369.001-1.295-.458-2.4-1.376-3.318zm-2.738 2.963c-.178.127-.428.189-.746.189h-.527v-1.508h.33c.34 0 .604.035.791.107.279.111.42.309.42.592 0 .286-.09.491-.268.62zm-1.273 1.127h.285l.301.018c.207.014.363.041.465.084a.626.626 0 0 1 .381.383c.043.109.07.322.084.637.012.312.039.553.082.719h1.299l-.043-.146c-.018-.051-.029-.102-.035-.152s-.01-.102-.01-.152v-.465c0-.531-.154-.92-.459-1.166-.166-.133-.412-.23-.738-.299.355-.039.656-.156.9-.352s.367-.512.367-.949c0-.572-.232-.986-.695-1.242-.271-.148-.613-.236-1.025-.268a75.74 75.74 0 0 0-1.072-.008c-.645-.004-1.127-.004-1.449-.004v5.203h1.363v-1.841h-.001z" />
                    </g>
                </svg>

            </a>
            <a href="#" class="flex items-center md:justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-27 hover:text-gray-900 dark:hover:text-white"
                    viewBox="0 0 192.744 192.744">
                    <g fill-rule="evenodd" clip-rule="evenodd">
                        <path fill="currentColor" fill="#fff" fill-opacity="0" d="M0 0h192.744v192.744H0V0z" />
                        <path fill="currentColor"
                            d="M119.305 64.872v-3.816h-15.266v20.952h15.266v-3.456h-11.018v-5.688h9.649V69.12h-9.649v-4.248h11.018zM115.057 84.168v8.064h-8.354v-8.064h-4.318v20.881h4.318v-9.361h8.354v9.361h4.248V84.168h-4.248zM119.305 110.951v-3.742h-15.266v21.238h15.266v-3.814h-11.018v-5.617h9.649v-3.455h-9.649v-4.61h11.018zM101.592 61.056h-4.248v8.064h-8.352v-8.064h-4.248v20.952h4.248v-9.36h8.352v9.36h4.248V61.056zM66.456 61.056v3.816h6.48v17.136h4.248V64.872h6.48v-3.816H66.456zM53.064 83.592c-6.696 0-10.224 3.816-10.224 11.016 0 7.56 3.528 11.304 10.224 11.304s10.152-3.744 10.152-11.304c0-7.2-3.456-11.016-10.152-11.016zm-5.616 11.016c0-4.824 1.872-7.2 5.616-7.2 4.032 0 5.904 2.376 5.904 7.2 0 5.113-1.872 7.56-5.904 7.56-3.744 0-5.616-2.447-5.616-7.56zM36.72 84.168v14.76l-8.352-14.76h-4.536v20.881h4.032V90.36l8.568 14.689h4.536V84.168H36.72zM56.52 115.848v-4.897h10.728v-3.742H52.272v21.238h4.248v-8.855h9.432v-3.744H56.52zM100.801 87.912v-3.744H83.664v3.744h6.408v17.137h4.32V87.912h6.409zM74.232 97.057c1.368 0 2.448.215 2.952.791l.792 7.201H82.8v-.504c-.504-.289-.792-1.584-.792-4.033 0-2.951-1.08-4.536-2.664-5.328 2.16-.864 3.24-2.448 3.24-5.112 0-3.744-2.16-5.904-6.696-5.904H65.376v20.881h4.32v-7.992h4.536zm-4.536-3.529v-5.616h5.328c2.16 0 3.24.792 3.24 2.664s-1.08 2.952-3.456 2.952h-5.112zM77.184 107.209h-5.112l-7.488 21.238h4.536l1.656-4.607h7.776l1.296 4.607h4.608l-7.272-21.238zm-2.664 4.822l2.664 8.354h-5.328l2.664-8.354zM98.137 114.191h4.248c-.217-1.871-.793-3.455-2.09-4.824-1.871-1.584-4.031-2.664-6.983-2.664s-5.112 1.08-6.984 2.953c-1.584 1.871-2.664 4.535-2.664 8.064 0 7.488 3.168 11.23 9.36 11.23 5.4 0 8.351-2.664 9.361-7.775h-4.248c-.576 2.447-2.449 3.744-4.825 3.744-3.528 0-5.112-2.375-5.112-6.984 0-5.039 1.584-7.488 5.112-7.488 2.376 0 3.745 1.369 4.825 3.744zM44.712 128.16h.072-.072zm.072 0c.72 0 1.296-.289 1.729-.648.36-.432.647-1.008.647-1.799 0-.865-.288-1.441-.647-1.801-.432-.359-1.008-.576-1.729-.576h-.072c-.864 0-1.44.217-1.8.576-.359.359-.576.936-.576 1.801v.07c0 .721.216 1.297.576 1.729.36.359.937.648 1.8.648h.072zm-.072.576c-1.008 0-1.728-.359-2.232-.865-.504-.504-.72-1.223-.72-2.088v-.07c0-1.01.216-1.729.72-2.232.504-.504 1.224-.721 2.232-.721h.072c.864 0 1.584.217 2.088.721s.864 1.223.864 2.232c0 .936-.36 1.654-.864 2.158a2.921 2.921 0 0 1-2.088.865h-.072zm.288-3.312h.072c.288 0 .432-.145.432-.504v-.072s-.072 0-.072-.072c-.072-.072-.216-.072-.432-.072h-.792v.721H45v-.001zm.504.504l.576.721c.072.143 0 .287-.072.359-.144.145-.36.072-.432 0l-.72-1.008h-.648v.791c0 .145-.144.289-.288.289s-.288-.145-.288-.289v-2.375c0-.145.144-.287.288-.287H45.072c.288 0 .576.07.72.215.072.072.144.072.144.145.144.145.144.287.144.432 0 .575-.144.862-.576 1.007zM122.256 61.056c13.393 0 24.984 4.896 34.344 14.256 9.648 9.648 14.473 21.168 14.473 34.631v18.504h-19.584v-19.08c0-7.486-2.664-13.967-8.064-19.295-1.297-1.368-2.664-2.448-4.248-3.528-4.32-2.952-9.432-4.248-14.76-4.248h-2.16v-21.24h-.001zm27.359 67.391h-15.264v-14.76c0-2.447-.791-4.32-2.447-5.904-1.584-1.654-3.744-2.447-5.904-2.447h-3.744V84.168h2.16c5.615 0 10.439 1.584 14.76 4.824 1.08.504 2.16 1.584 2.951 2.376 5.113 5.113 7.488 11.017 7.488 18v19.079zm-17.135 0h-10.225v-21.238H126c1.656 0 3.24.574 4.607 1.871 1.08 1.08 1.873 2.736 1.873 4.607v14.76z" />
                    </g>
                </svg>

            </a>
            <a href="#" class="flex items-center md:justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class=" w-20 hover:text-gray-900 dark:hover:text-white"
                    viewBox="0 0 26.088 26.999">
                    <path fill="currentColor"
                        d="M5.208 3.78V5c-.439.39-1.488.622-2.269.622C2.159 5.622 0 5.134 0 2.841S2.055.054 2.884.054c.83 0 1.714.152 2.226.494v1.073c0 .134-.183.122-.183 0-.012-.183-.5-1.28-1.72-1.256C1.89.392 1 1.427 1 2.792s.865 2.537 2.171 2.5c.424-.012.866-.146 1.08-.324l.005-1.188c0-.341-.207-.463-.414-.463-.135 0-.135-.195 0-.195h1.78c.134 0 .134.207 0 .195-.206 0-.414.122-.414.463zm12.001-2.158c0 .134-.134.122-.134 0-.013-.183-.5-1.317-1.72-1.292-1.317.026-2.208 1.098-2.208 2.463s.854 2.573 2.159 2.537c1.305-.037 1.927-1.329 1.976-1.5s.134-.146.134-.012v1c-.536.39-1.549.805-2.329.805s-2.939-.488-2.939-2.781C12.148.548 14.197 0 15.026 0c.83 0 1.671.207 2.184.548v1.074zM25.942.134c.195 0 .195.183 0 .183-.208 0-.415.122-.415.463v4.061c0 .341.207.463.415.463.195 0 .195.244 0 .244h-1.793c-.195 0-.195-.244 0-.244.208 0 .415-.122.415-.463V.78c0-.342-.207-.463-.415-.463-.195 0-.195-.183 0-.183h1.793zm-14.258 0c.195 0 .195.183 0 .183-.207 0-.414.122-.414.463l-.024 2.665c0 1.276-1.035 2.214-2.312 2.214S6.66 4.721 6.66 3.445V.78c0-.342-.208-.463-.415-.463-.195 0-.195-.183 0-.183H8.05c.195 0 .195.183 0 .183-.208 0-.415.122-.415.463l-.002 2.976c0 .9.736 1.63 1.636 1.63.9 0 1.63-.913 1.63-1.812L10.855.78c0-.342-.207-.463-.415-.463-.194 0-.194-.183 0-.183h1.244zm1.669 11.948a7.854 7.854 0 0 1 3.49-.812 7.865 7.865 0 1 1-3.488 14.915A7.864 7.864 0 1 1 9.867 11.27c1.254 0 2.434.292 3.486.812zm1.586 1.033a7.768 7.768 0 0 1 2.513 3.917h-1.63a6.311 6.311 0 0 0-2.469-3.159 6.318 6.318 0 0 0-2.465 3.157l-1.629.001a7.837 7.837 0 0 1 2.522-3.924 6.404 6.404 0 0 0-1.915-.286 6.312 6.312 0 1 0 1.891 12.336 7.827 7.827 0 0 1-2.754-5.392h3.742v1.569l-1.82-.001a6.328 6.328 0 0 0 2.433 3.063 6.288 6.288 0 0 0 2.428-3.063l-1.82.001v-1.569h3.742a7.83 7.83 0 0 1-2.78 5.383 6.312 6.312 0 1 0 .011-12.033zm8.234-11.493c0 .134-.134.122-.134 0-.012-.183-.5-1.317-1.72-1.292-1.317.026-2.208 1.098-2.208 2.463s.854 2.573 2.159 2.537 1.927-1.329 1.976-1.5.135-.146.135-.012v1c-.537.39-1.549.805-2.33.805-.78 0-2.939-.488-2.939-2.781C18.112.548 20.161 0 20.991 0c.829 0 1.671.207 2.183.548v1.074z" />
                </svg>

            </a>
            <a href="#" class="flex items-center md:justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class=" w-22 hover:text-gray-900 dark:hover:text-white"
                    viewBox="0 0 192.756 192.756">
                    <g fill-rule="evenodd" clip-rule="evenodd">
                        <path fill="currentColor" fill="#fff" fill-opacity="0" d="M0 0h192.756v192.756H0V0z" />
                        <path fill="currentColor"
                            d="M17.897 108.844c-6.549 0-12.139-5.94-12.139-12.419 0-6.455 5.473-12.513 12.092-12.513 4.351 0 7.484 2.105 10.034 5.403h3.204c-.959-1.731-1.988-3.321-3.555-4.561-2.69-2.175-6.175-3.461-9.636-3.461-8.303 0-15.062 6.853-15.062 15.109 0 8.279 6.853 15.062 15.109 15.062 3.368 0 6.666-1.239 9.309-3.321 1.661-1.333 2.83-3.064 3.953-4.842h-3.204c-2.527 3.298-5.754 5.543-10.105 5.543zM51.109 93.057c-2.011-2.596-4.748-4.233-8.139-4.233-6.081 0-11.086 4.936-11.086 11.017 0 6.08 5.029 11.062 11.086 11.062 3.532 0 5.987-1.474 8.139-4.187v3.695h2.643V89.338h-2.643v3.719zM42.83 108.47c-4.655 0-8.327-4.046-8.327-8.606 0-4.538 3.649-8.607 8.327-8.607 4.654 0 8.279 4.07 8.279 8.607 0 4.56-3.649 8.606-8.279 8.606zM56.956 110.411h2.831V81.9h-2.831v28.511zM70.475 107.066l-7.157-17.728h-2.807l8.584 21.073h2.853l8.561-21.073h-2.76l-7.274 17.728zM81.678 110.411h2.83V89.338h-2.83v21.073zM81.678 86.625h2.83V81.9h-2.83v4.725zM96.694 88.823c-2.667 0-4.561 1.404-6.315 3.275v-2.76h-2.62v21.073h2.783V97.57c-.023-3.391 2.783-6.314 6.198-6.314 4.279 0 6.431 3.719 6.431 7.555v11.601h2.619V98.811c.001-5.473-3.202-9.988-9.096-9.988zM132.057 81.9l-12.864 16.349V81.9h-2.783v28.511h2.783v-7.835l3.649-4.537 9.285 12.372h3.533l-11.041-14.618L135.66 81.9h-3.603zM136.688 110.411h2.761V81.9h-2.761v28.511zM162.299 94.647c-1.918-3.579-5.754-5.824-9.801-5.824-6.033 0-11.133 5.029-11.133 11.063 0 6.08 5.146 11.016 11.182 11.016 2.875 0 5.707-1.146 7.787-3.134 1.264-1.193 2.012-2.69 2.689-4.257h-2.969c-1.498 2.924-4.141 4.958-7.557 4.958-2.08 0-4.115-.842-5.658-2.269-1.592-1.449-2.293-3.228-2.598-5.332h19.438c.001-2.198-.304-4.303-1.38-6.221zm-17.963 3.789c.844-3.952 3.953-7.18 8.211-7.18 3.578 0 7.414 2.199 8.256 7.18h-16.467zM165.738 110.411h2.782V89.338h-2.782v21.073zM165.738 86.719h2.782V81.9h-2.782v4.819zM180.754 88.823c-2.715 0-4.609 1.404-6.387 3.275v-2.76h-2.666v21.073h2.807V97.57c-.023-3.414 2.854-6.314 6.291-6.314 4.258 0 6.504 3.719 6.504 7.555v11.601h2.619V98.811c0-5.473-3.252-9.988-9.168-9.988z" />
                    </g>
                </svg>

            </a>
            <a href="#" class="flex items-center md:justify-center">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 2500 583"
                    class=" w-22 hover:text-gray-900 dark:hover:text-white" xml:space="preserve">
                    <path fill="currentColor" d="M508.9,501.4c0,39.3-32.8,71.2-57.5,71.2H172.1L523.4,11.4H53.7v93h24.1c0-39.3,25.4-71.1,50.2-71.1h241.3L15.9,594.4h509.6
               l0-93H508.9" />
                    <g>
                        <polygon points="918.3,576.1 918.3,576.1 918.3,576.1 	" />
                        <path fill="currentColor" d="M1118.4,549L846.6,11.4l-249.1,538c-4.4,11.8-28.4,26.7-62.4,26.7v18.2h132.6v-18.2c-24.6,0-51-12.2-44.6-26.8L683,419.4
                   h229.8L978.1,549c7.4,13.1-25.7,27.2-59.8,27.2v18.2h276l0.1-18.2C1152.6,576.1,1127.1,563.1,1118.4,549z M693,398.4l99.4-218.2
                   l111,218.2H693z" />
                    </g>
                    <path fill="currentColor" d="M1226,33.9c40.4,0,73.8,10.4,73.8,23c0,100-0.2,491.5,0,491.5c0,13.4-32.9,28.3-73.4,28.3l-0.1,17.6h270.2v-16.4
               c-40.1,0-72.6-16-72.6-29.4V29h77.9c75,0,135.8,62.3,135.8,133c0,70.7-60.8,128.1-135.9,128.1h-53.9c0,0,182.6,276.5,182.9,276.5
               c7.2,10.5,10.8,27.8,10.8,27.8h196.9v-16.4c-37.9,0-57.7-15.7-68.7-29.5l-175.8-229.4c84.4-5.6,149.7-73.8,149.7-154.8
               c0-84.6-72.7-152.9-162.4-152.9H1226V33.9" />
                    <path fill="currentColor" d="M2440,549L2168.2,11.4l-249.1,538c-4.4,11.8-28.3,27.3-62.4,27.3v17.6h132.6v-16.4c-24.6,0-50.9-14-44.6-28.6l59.9-129.9
               h229.8l65.3,129.6c7.5,13.1-25.7,27.8-59.8,27.8h0v17.6h276l0.1-17C2474.2,577.4,2448.7,563.1,2440,549z M2014.5,398.4l99.4-218.2
               l111,218.2H2014.5z" />
                </svg>
            </a>
        </div>
    </section>
    {{-- Hero end --}}

    <section class="bg-white-50 py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Kategori</h2>


            </div>

            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($categories as $category)
                    <a href="#"
                        class="flex items-center md:justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category?->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Start --}}

    {{-- <section class="bg-white dark:bg-gray-900 py-8 antialiased">
        <div class="py-6 mx-auto grid max-w-screen-xl px-4 md:grid-cols-3 md:gap-8 lg:gap-8  xl:gap-8">
            <div
                class="bg-gray-100 w-full dark:bg-gray-100 px-6 py-4 flex flex-col items-center rounded-lg shadow-lg md:py-6">
                @svg('fas-truck', 'w-8 h-8 text-primary-700')
                <span class="dark:text-gray-900 font-bold text-lg">Gratis Pengiriman</span>
                <span class="dark:text-gray-900 "> Gratis Pengiriman Seluruh Indonesia!!!</span>
            </div>
            <div
                class="bg-gray-100 w-full dark:bg-gray-100 px-6 py-4 flex flex-col items-center rounded-lg shadow-lg md:py-6">
                @svg('fas-truck', 'w-8 h-8 text-primary-700')
                <span class="dark:text-gray-900 font-bold text-lg">Gratis Pengiriman</span>
                <span class="dark:text-gray-900 "> Gratis Pengiriman Seluruh Indonesia!!!</span>
            </div>
            <div
                class="bg-gray-100 w-full dark:bg-gray-100 px-6 py-4 flex flex-col items-center rounded-lg shadow-lg md:py-6">
                @svg('fas-truck', 'w-8 h-8 text-primary-700')
                <span class="dark:text-gray-900 font-bold text-lg">Gratis Pengiriman</span>
                <span class="dark:text-gray-900 "> Gratis Pengiriman Seluruh Indonesia!!!</span>
            </div>
        </div>
    </section> --}}

    {{-- Featured End --}}

    {{-- Discount Start --}}
    <section class="bg-white px-4 py-8 antialiased dark:bg-gray-900 md:py-16">
        <div
            class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16">
            <div class="lg:col-span-5 lg:mt-0">
                <a href="#">
                    <img class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-components.svg"
                        alt="peripherals" />
                    <img class="mb-4 hidden dark:block md:h-full"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-components-dark.svg"
                        alt="peripherals" />
                </a>
            </div>
            <div class="me-auto place-self-center lg:col-span-7">
                <h1
                    class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                    Save $500 today on your purchase <br />
                    of a new iMac computer.
                </h1>
                <p class="mb-6 text-gray-500 dark:text-gray-400">Reserve your new Apple iMac 27” today and enjoy
                    exclusive savings with qualified activation. Pre-order now to secure your discount.</p>
                <a href="#"
                    class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Pre-order now </a>
            </div>
        </div>
    </section>
    {{-- Discount End --}}

    {{-- Feature section --}}
    {{-- <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Designed for
                    business teams like yours</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where
                    technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Marketing</h3>
                    <p class="text-gray-500 dark:text-gray-400">Plan it, create it, launch it. Collaborate seamlessly
                        with all the organization and hit your marketing goals every month with our marketing plan.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Legal</h3>
                    <p class="text-gray-500 dark:text-gray-400">Protect your organization, devices and stay compliant
                        with our structured workflows and custom permissions made for you.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                            <path
                                d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Business Automation</h3>
                    <p class="text-gray-500 dark:text-gray-400">Auto-assign tasks, send Slack messages, and much more.
                        Now power up with hundreds of new templates to help you get started.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Finance</h3>
                    <p class="text-gray-500 dark:text-gray-400">Audit-proof software built for critical financial
                        operations like month-end close and quarterly budgeting.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Enterprise Design</h3>
                    <p class="text-gray-500 dark:text-gray-400">Craft beautiful, delightful experiences for both
                        marketing and product with real cross-company collaboration.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Operations</h3>
                    <p class="text-gray-500 dark:text-gray-400">Keep your company’s lights on with customizable,
                        iterative, and structured workflows built for all efficient teams and individual.</p>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- End --}}

    {{-- Latest Product --}}
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <div>

                    <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Produk Terbaru
                    </h2>
                </div>

            </div>
            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                @isset($products)
                    @foreach ($products as $prod)
                        <livewire:frontend-sub-component::productcard :product="$prod" lazy :key="$prod->id" />
                    @endforeach
                @else
                    <section class="bg-white dark:bg-gray-900 col-span-4">
                        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                            <div class="mx-auto max-w-screen-sm text-center">
                                <h1
                                    class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                                    404</h1>
                                <p
                                    class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                                    Wadooh</p>
                                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Yah, Produk yang
                                    anda cari tidak ditemukan</p>
                                <a href="{{ route('frontend.home') }}" wire:navigate
                                    class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">
                                    Kembali Ke Beranda
                                </a>
                            </div>
                        </div>
                    </section>
                @endisset
            </div>
            <div class="w-full text-center">
                {{ $products->links() }}
            </div>
        </div>

    </section>
    {{-- End --}}
</div>
