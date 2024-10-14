@php
    $classType = match ($type) {
        'success' => 'text-green-800 bg-green-50 dark:text-green-400',
        'danger' => ' text-red-800 bg-red-50 dark:text-red-400',
        'warning' => ' text-primary-800 bg-primary-50 dark:text-primary-400',
    };
@endphp
<div class="fixed top-2 right-3 z-50">
    <div id="alert"
        class="{{ $show == true ? 'flex' : 'hidden' }} {{ $classType }} items-center p-4 mb-4 rounded-lg  dark:bg-gray-800 "
        role="alert">
        @if ($icon == 'check')
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20" aria-hidden="true">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 10l3 3l5-5" />
            </svg>
        @elseif ($icon == 'ban')
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <circle cx="12" cy="12" r="10" />
                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
            </svg>
        @elseif ($icon == 'exclamation')
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <line x1="12" y1="8" x2="12" y2="16" />
                <line x1="12" y1="20" x2="12" y2="20" />
            </svg>
        @endif
        <div class="ms-3 text-sm font-medium">
            {{ $message }}
        </div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-{{ $classType }}-50 text-{{ $classType }}-500 rounded-lg focus:ring-2 focus:ring-{{ $classType }}-400 p-1.5 hover:bg-{{ $classType }}-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-{{ $classType }}-400 dark:hover:bg-gray-700"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
</div>
<script>
    window.addEventListener('admin-alert', event => {
        const toast = document.getElementById('alert');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);

    });
</script>
