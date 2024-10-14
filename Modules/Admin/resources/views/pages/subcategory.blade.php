<div>
    {{ $this->table }}


    {{-- Modal Create SubCategory   --}}
    <div id="modalSubCategoryCreate" wire:ignore tabindex="-1" data-modal-backdrop="static" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Buat Sub Kategori
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modalSubCategoryCreate">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" wire:submit="createSubCategoryAction">
                        {{ $this->createSubCategoryForm }}
                        <div class="pt-8 flex justify-start">
                            <x-filament::button type="submit" color="primary" wire:target="createSubCategoryAction">
                                @svg('fas-plus', [
                                    'class' => 'inline w-4 h-4 me-1 text-white',
                                    'wire:loading.remove' => 'wire:loading.remove',
                                    'wire:target' => 'createSubCategoryAction',
                                ])
                                Buat Sub Kategori
                            </x-filament::button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@script
    <script>
        const closeModalCreateSubCategory = () => {
            const modalBackdrop = new Modal(document.getElementById('modalSubCategoryCreate'));
            modalBackdrop.hide();
        }

        Livewire.on('subCategoryCreated', () => {
            closeModalCreateSubCategory();
        })
    </script>
@endscript
