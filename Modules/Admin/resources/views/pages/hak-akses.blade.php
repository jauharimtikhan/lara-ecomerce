<div>
    <x-filament::card>
        <div
            class="mb-4 border-b border-gray-200 dark:border-gray-700 flex flex-wrap items-center justify-between sm:my-5">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" role="tablist">
                @foreach ($roleWithPermissions as $role)
                    @php
                        $buttonClasses =
                            'inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300';
                        $clearName = str_replace(' ', '-', $role->name);
                        if ($clearName == $defaultShowTabs) {
                            $buttonClasses =
                                'inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300 text-primary-600 hover:text-primary-600 dark:text-primary-500 dark:hover:text-primary-400 border-primary-600 dark:border-primary-500';
                        } else {
                            $buttonClasses =
                                'inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300';
                        }
                    @endphp
                    <li class="me-2" role="presentation" wire:key="{{ $role->uuid }}">
                        <button wire:click="setDefaultShowTabs('{{ $clearName }}')" class="{{ $buttonClasses }}"
                            id="{{ str_replace(' ', '-', $role->name) }}-tab" type="button" role="tab"
                            aria-controls="{{ str_replace(' ', '-', $role->name) }}" aria-selected="false">
                            <svg wire:loading wire:target="setDefaultShowTabs('{{ $clearName }}')" aria-hidden="true"
                                role="status" class="inline w-4 h-4 me-1 text-white animate-spin" viewBox="0 0 100 101"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor" />
                            </svg>
                            @php
                                $clears = str_replace('_', ' ', $role->name);
                            @endphp
                            {{ ucfirst($clears) }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div>
                <x-filament::button color="info" wire:click="generatePermission">
                    @svg('heroicon-m-cog-6-tooth', ['class' => 'inline w-4 h-4 me-1 text-white', 'wire:loading.remove' => 'wire:loading.remove', 'wire:target' => 'generatePermission'])
                    Generate Permission
                </x-filament::button>
            </div>
        </div>
        <div id="default-tab-content">
            @foreach ($roleWithPermissions as $role)
                @php
                    $groupedPermissions = $permissions->sortBy('name')->groupBy(function ($permission) {
                        return explode('-', $permission->name)[0];
                    });
                @endphp


                <div class="{{ str_replace(' ', '-', $role->name) == $defaultShowTabs ? '' : 'hidden' }} p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                    wire:key="{{ $role->uuid }}-{{ $permissions->pluck('uuid')->first() }}"
                    id="{{ str_replace(' ', '-', $role->name) }}-panel" role="tabpanel"
                    aria-labelledby="{{ str_replace(' ', '-', $role->name) }}-tab">
                    <div class="pb-6 flex flex-wrap items-center justify-between">
                        @php
                            $colorGroupName = match ($role->name) {
                                'Admin' => 'text-success-900 dark:text-success-400',
                                'Visitor' => 'text-indigo-900 dark:text-indigo-400',
                                'Member' => 'text-red-900 dark:text-red-400',
                                'Super Admin' => 'text-fuchsia-900 dark:text-fuchsia-400',
                                default => 'text-gray-900 dark:text-white',
                            };

                            $groupNames = str_replace('_', ' ', $role->name);
                        @endphp

                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Hak Akses Role:
                            <strong class="underline {{ $colorGroupName }}">{{ ucfirst($groupNames) }}</strong>
                        </h1>

                        <div>
                            <button id="dropdown-action-{{ $role->uuid }}"
                                data-dropdown-toggle="dropdownDotsHorizontal-{{ $role->uuid }}"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdownDotsHorizontal-{{ $role->uuid }}"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdown-action-{{ $role->uuid }}">
                                    <li>
                                        <button type="button" wire:click="edit('{{ $role->uuid }}')"
                                            class="inline-flex items-center space-x-4 w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            @svg('bxs-edit', [
                                                'class' => 'inline w-4 h-4 me-3 text-white',
                                                'wire:loading.remove' => 'wire:loading.remove',
                                                'wire:target' => "edit('$role->uuid')",
                                            ])
                                            <svg wire:loading wire:target="edit('{{ $role->uuid }}')"
                                                aria-hidden="true" role="status"
                                                class="inline w-4 h-4 me-3 text-white animate-spin"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="#E5E7EB" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentColor" />
                                            </svg>
                                            Edit
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" wire:click="deleteRole('{{ $role->uuid }}')"
                                            class="inline-flex space-x-4 items-center w-full text-left text-red-500 dark:text-red-500 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            @svg('heroicon-s-trash', [
                                                'class' => 'inline w-4 h-4 me-3 text-red-500',
                                                'wire:loading.remove' => 'wire:loading.remove',
                                                'wire:target' => 'deleteRole(\'{{ $role->uuid }}\')',
                                            ])
                                            <svg wire:loading wire:target="deleteRole('{{ $role->uuid }}')"
                                                aria-hidden="true" role="status"
                                                class="inline w-4 h-4 me-3 text-white animate-spin"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="#E5E7EB" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentColor" />
                                            </svg>
                                            Delete
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="grid lg:grid-cols-2 gap-4">
                        @foreach ($groupedPermissions as $groupName => $groupPermission)
                            @php
                                $formatGroupName = explode('-', $groupName)[0];
                                $color = match ($formatGroupName) {
                                    'admin' => 'text-lg font-semibold text-success-900 dark:text-success-400',
                                    'filament' => 'text-lg font-semibold text-indigo-900 dark:text-indigo-400',
                                    'frontend' => 'text-lg font-semibold text-yellow-900 dark:text-yellow-400',
                                    'home' => 'text-lg font-semibold text-fuchsia-900 dark:text-fuchsia-400',
                                    'livewire' => 'text-lg font-semibold text-red-900 dark:text-red-400',
                                    'storage' => 'text-lg font-semibold text-green-900 dark:text-green-400',
                                    default => 'text-lg font-semibold text-gray-900 dark:text-white',
                                };
                            @endphp
                            <div class="bg-white rounded-lg p-4 dark:bg-gray-900 w-full"
                                wire:key="{{ $formatGroupName }}">
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="{{ $color }}">
                                        {{ ucfirst($formatGroupName) }}
                                    </h3>
                                </div>
                                <div class="grid grid-cols-2 gap-4 py-2">
                                    @foreach ($groupPermission as $permission)
                                        @php
                                            $colorCheckBox = match ($formatGroupName) {
                                                'admin' => 'success',
                                                'filament' => 'indigo',
                                                'frontend' => 'yellow',
                                                'home' => 'fuchsia',
                                                'livewire' => 'red',
                                                'storage' => 'green',
                                                default => 'gray',
                                            };
                                        @endphp

                                        <x-admin-component::checkbox
                                            wire_key="{{ $permission->uuid . '-' . $role->uuid }}" :color="$colorCheckBox"
                                            :id="$permission->uuid . '-' . $role->uuid" :value="$permission->name" data_role_id="{{ $role->uuid }}"
                                            data_permission_id="{{ $permission->uuid }}"
                                            data_parent_id="{{ str_replace(' ', '-', $role->name) }}-panel"
                                            :checked="$role->permissions->contains('uuid', $permission->uuid)
                                                ? 'checked'
                                                : ''">{{ $permission->name }}</x-admin-component::checkbox>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endforeach

        </div>
    </x-filament::card>




    {{-- Create Permission modal  --}}
    <div id="create-permission" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Buat Hak Akses Baru
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="create-permission">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5 " wire:submit="create">
                    <div class="gap-4 mb-4">
                        {{ $this->createForm }}
                    </div>
                    <div class="flex justify-end items-center">
                        <button type="submit"
                            class="text-white  inline-flex  items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg wire:loading wire:target="create" aria-hidden="true" role="status"
                                class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor" />
                            </svg>
                            <svg wire:loading.remove wire:target="create" class="me-1 -ms-1 w-5 h-5"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Buat Hak Akses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Permission Modal --}}
    <div id="update-permission" wire:ignore tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Hak Akses User
                    </h3>
                    <button type="button" id="closeModalUpdateRole"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5 " wire:submit="updateRoleForm">
                    <div class="gap-4 mb-4">
                        {{ $this->updateRole }}
                    </div>
                    <div class="flex justify-end items-center">
                        <x-filament::button type="submit" color="warning"
                            wire:target="updateRoleForm">Update</x-filament::button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@script
    <script>
        const closeModalOnNotification = () => {
            const modalBackdrop = document.getElementById('create-permission');
            if (modalBackdrop) {
                const modal = new Modal(modalBackdrop);
                modal.hide();
            }
        };
        document.addEventListener('filament-notification', function() {
            closeModalOnNotification();

        })



        document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const roleId = this.getAttribute('data-role-id');
                const permissionId = this.getAttribute('data-permission-id');
                const isChecked = this.checked;

                $wire.updatePermission({
                    roleId,
                    permissionId,
                    isChecked
                })

            })
        });

        const $targetEl = document.getElementById("update-permission");

        // options with default values
        const options = {
            placement: "top-center",
            backdrop: "static",
            closable: true,
            onHide: () => {
                console.log("modal is hidden");
            },
            onShow: () => {
                console.log("modal is shown");
            },
            onToggle: () => {
                console.log("modal has been toggled");
            },
        };

        // instance options object
        const instanceOptions = {
            id: "update-permission",
            override: true,
        };

        const modal = new Modal($targetEl, options, instanceOptions);
        const closeModalUpdateRole = document.getElementById('closeModalUpdateRole');

        Livewire.on('call-modal-update', () => {
            modal.show();
        });

        closeModalUpdateRole.addEventListener('click', () => {
            modal.hide();
        })
    </script>
@endscript
