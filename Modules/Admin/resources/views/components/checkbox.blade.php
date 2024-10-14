@props([
    'id' => '#',
    'color' => 'red',
    'value' => '',
    'data_role_id' => '',
    'data_permission_id' => '',
    'checked' => '',
    'wire_key',
    'data_parent_id',
])
@php
    $colorBase = match ($color) {
        'red'
            => 'text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'fuchsia'
            => 'text-fuchsia-600 bg-fuchsia-100 border-fuchsia-300 rounded focus:ring-fuchsia-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'green'
            => 'text-green-600 bg-green-100 border-green-300 rounded focus:ring-green-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'yellow'
            => 'text-yellow-600 bg-yellow-100 border-yellow-300 rounded focus:ring-yellow-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'indigo'
            => 'text-indigo-600 bg-indigo-100 border-indigo-300 rounded focus:ring-indigo-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'success'
            => 'text-success-600 bg-success-100 border-success-300 rounded focus:ring-success-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        default
            => 'text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
    };
@endphp

<div class="flex items-center me-4">
    <input {{ $checked }} id="{{ $id }}" type="checkbox" value="{{ $value }}"
        wire:key="{{ $wire_key }}" class="w-4 h-4 form-check-input {{ $colorBase }}"
        data-role-id="{{ $data_role_id }}" data-permission-id="{{ $data_permission_id }}"
        data-parent-id="{{ $data_parent_id }}">
    <label for="{{ $id }}"
        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $slot }}</label>
</div>
