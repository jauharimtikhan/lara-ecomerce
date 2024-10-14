<div>
    <form wire:submit="update" class="px-4 py-4 bg-white dark:bg-gray-800 rounded-lg">
        {{ $this->form }}
        <div class="mt-4 flex justify-end space-x-3">
            <x-filament::button type="button" color="danger">
                <x-filament::link color="white" class="no-underline" href="{{ route('admin.product') }}"
                    wire:navigate>Kembali</x-filament::link>
            </x-filament::button>
            <x-filament::button type="submit" wire:target="update">Update Produk</x-filament::button>
        </div>
    </form>
</div>
