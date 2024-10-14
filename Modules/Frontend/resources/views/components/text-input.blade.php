@props([
    'type' => 'text',
    'name',
    'label' => '',
    'placeholder' => '',
    'required' => false,
])

<div>
    <label for="{{ $name }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label !== '' ? $label : $name }}</label>
    <input type="{{ $type }}" wire:model="{{ $name }}" id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        {{ $required ? 'required' : '' }}>
    @error($name)
        <span class="text-red-500 mt-1">{{ $message }}</span>
    @enderror
</div>
