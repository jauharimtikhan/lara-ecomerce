@props(['id', 'name', 'label' => ''])
<div>
    <label for="{{ $id }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label !== '' ? $label : $name }}</label>
    <select id="{{ $id }}" {{ $attributes->whereStartsWith('wire:model') }} {{ $attributes }}
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        {{ $slot }}
    </select>
    @error($name)
        <span class="text-red-500 mt-1">
            {{ $message }}
        </span>
    @enderror
</div>
