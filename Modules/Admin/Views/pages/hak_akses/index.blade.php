@extends('admin::layout.main', ['title' => 'Hak Akses'])
@section('content-header')
    <div class="content-header d-flex justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.hakakses.index') }}">Hak Akses</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Hak Akses</h4>
        </div>
        <div class="d-flex justify-content-end">
            {{-- <button type="button" class="btn btn-primary btn-sm rounded-10" data-toggle="modal"
                data-target="#modalAddSubKategori">
                <i data-feather="plus"></i>
                Tambah Sub Kategori
            </button> --}}
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body rounded-10">
        <ul class="list-group list-group-flush">
            @foreach ($roleWithPermissions as $role)
                <li class="list-group-item select-none cursor-pointer {{ $role->name !== 'super_admin' ? 'collapsed' : '' }}"
                    data-toggle="collapse" href="#collapse-{{ $role->uuid }}" role="button" aria-expanded="false"
                    aria-controls="collapse-{{ $role->uuid }}">Role: {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                </li>
                <div class="collapse {{ $role->name === 'super_admin' ? 'show' : '' }} my-3"
                    id="collapse-{{ $role->uuid }}">
                    <div class="card card-body rounded-10">
                        <div class="row g-2">
                            @php
                                $groupedPermissions = $permissions->sortBy('name')->groupBy(function ($permission) {
                                    return explode('_', $permission->name)[0];
                                });
                            @endphp
                            @foreach ($groupedPermissions as $groupName => $groupPermission)
                                @php
                                    $formatGroupName = explode('_', $groupName)[0];
                                @endphp
                                <div class="col-6">
                                    <div role="button"
                                        class="border cursor-pointer p-3 my-1 rounded-10 bg-body-tertiary d-flex  justify-content-between align-items-center"
                                        data-toggle="collapse"
                                        data-target="#{{ $groupName }}-{{ $groupPermission->pluck('uuid')->first() }}-{{ $role->uuid }}"
                                        aria-expanded="false"
                                        aria-controls="{{ $groupName }}-{{ $groupPermission->pluck('uuid')->first() }}-{{ $role->uuid }}">
                                        <h5 class="text-center mb-0 select-none">{{ ucfirst($formatGroupName) }}</h5>

                                    </div>
                                    <div class="collapse"
                                        id="{{ $groupName }}-{{ $groupPermission->pluck('uuid')->first() }}-{{ $role->uuid }}">
                                        <div class="card card-body rounded-10">
                                            <div class="row">
                                                @foreach ($groupPermission as $permission)
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $permission->name }}"
                                                                id="permission-{{ $permission->uuid }}-{{ $role->uuid }}"
                                                                data-role-id="{{ $role->uuid }}"
                                                                data-permission-id="{{ $permission->uuid }}"
                                                                {{ $role->permissions->contains('uuid', $permission->uuid) ? 'checked' : '' }}>
                                                            <label class="form-check-label select-none cursor-pointer"
                                                                for="permission-{{ $permission->uuid }}-{{ $role->uuid }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mnHakAkses').addClass('active');

            document.querySelectorAll('.form-check-input').forEach(function(checkbox) {

                checkbox.addEventListener('change', function() {
                    const roleId = this.getAttribute('data-role-id');
                    const permissionId = this.getAttribute('data-permission-id');
                    const isChecked = this.checked;


                    $.ajax({
                        url: $.route('admin.hakakses.store'),
                        method: 'post',
                        data: {
                            role_id: roleId,
                            permission_id: permissionId,
                            checked: isChecked
                        },
                        success: function(res) {
                            if (res.status == true) {
                                Toast({
                                    icon: 'success',
                                    title: res.message
                                });
                            }
                        },
                        error: function(err) {
                            if (err.responseJSON.status == false) {
                                Toast({
                                    icon: 'error',
                                    title: err.responseJSON.message
                                });
                            }
                        }
                    })
                });
            });
        });

        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        }
    </script>
@endpush
