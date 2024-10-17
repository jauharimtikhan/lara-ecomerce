<div id="alert-{{ session()->getId() }}"
    class="fixed top-4 right-4 z-[2000] {{ $show ? 'flex' : 'hidden' }} items-center w-full max-w-xs p-4 text-{{ $type }}-500 bg-white rounded-lg shadow dark:text-{{ $type }}-400 dark:bg-gray-800"
    role="alert">
    <div
        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-{{ $type }}-500 bg-{{ $type }}-100 rounded-lg dark:bg-{{ $type }}-800 dark:text-{{ $type }}-200">
        @if ($icon == 'check')
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20" aria-hidden="true">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 10l3 3l5-5" />
            </svg>
        @elseif ($icon == 'ban')
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <circle cx="12" cy="12" r="10" />
                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
            </svg>
        @elseif ($icon == 'exclamation')
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <line x1="12" y1="8" x2="12" y2="16" />
                <line x1="12" y1="20" x2="12" y2="20" />
            </svg>
        @elseif($icon == 'warning')
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <path
                    d="M10.29 3.86l-6.17 10.74c-.81 1.42.21 3.18 1.81 3.18h12.34c1.6 0 2.62-1.76 1.81-3.18l-6.17-10.74a2.42 2.42 0 0 0-4.34 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12" y2="17" />
            </svg>
        @endif

    </div>
    <div class="ms-3 text-sm font-normal" id="message-{{ $type }}-body">{{ $message }}</div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        aria-label="Close" data-dismiss-target="#alert-{{ session()->getId() }}">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>
