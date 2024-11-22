@extends('admin::layout.main', ['title' => 'Edit Member'])
@section('content-header')
    <div class="content-header d-flex justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.user.index') }}">Member</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Member</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Edit Member</h4>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary btn-sm rounded-10">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body rounded-lg">
        <form action="{{ route('admin.user.update', $user->id) }}" method="post" id="formEditUser">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama Member</label>
                        <input type="text" value="{{ $user->name }}" placeholder="Masukan Nama Member" name="nama"
                            id="nama" class="form-control rounded-10">
                        <span class="text-danger nama"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Member</label>
                        <input type="text" value="{{ $user->email }}" name="email" id="email"
                            placeholder="Masukan Email Member" class="form-control rounded-10">
                        <span class="text-danger email"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role">Role Member</label>
                        <select name="role" id="role" class="form-control rounded-10 select2 "></select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password Member</label>
                        <div class="input-group">
                            <input type="text" class="form-control rounded-10"
                                placeholder="Buat Password Baru Atau Biarkan Kosong" name="password" id="password"
                                value="{{ $user->password }}">
                            <div class="input-group-append">
                                <button data-toggle="tooltip" data-placement="top" title="Buat Random Password"
                                    class="btn tooltip-primary btn-outline-light rounded-t-b-r" type="button"
                                    id="generatePass"><i data-feather="settings"></i></button>
                            </div>
                        </div>
                        <span class="text-danger password">*biarkan jika tidak ingin di ubah!!!</span>
                    </div>
                </div>
            </div>
            <div class="mt-3 float-right">
                <button type="submit" class="btn btn-success btn-sm rounded-10">
                    <i data-feather="send"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#mnUser').addClass('active');

        var app = {
            init: function() {
                $('.select2').select2({
                    placeholder: 'Pilih Salah Satu',
                    searchInputPlaceholder: 'Cari Role',
                    data: app.initDataRoles(),
                    selected: function() {
                        var selected = $(this).val();
                        if (selected == 0) {
                            console.log('ok');

                        }
                    }
                });
                $('.select2').val("{{ $user->roles->first()->uuid }}").trigger('change');
                this.generatePass()
                this.addUser()
            },
            initDataRoles: function() {
                let data = []

                $.each(@json($roles), function(i, val) {
                    data.push({
                        id: val.uuid,
                        text: val.name
                    })
                })
                return data;
            },
            generatePass: function() {
                var pass = Math.random().toString(36).substr(2, 10);
                $('#generatePass').on('click', function() {
                    $('#password').val(pass);
                })
            },
            addUser: function() {
                $('#formEditUser').submit(function(e) {
                    e.preventDefault();

                    const submitButton = $('button[type="submit"]');
                    const originalIcon = submitButton.html();
                    let formData = new FormData(this);
                    // formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            submitButton.html(
                                '<i class="fas fa-spinner fa-spin"></i>'
                            );
                        },
                        success: function(response) {
                            if (response.status == 201) {
                                Toast({
                                    icon: 'success',
                                    title: response.message
                                }).then(() => {
                                    window.location.href =
                                        "{{ route('admin.user.index') }}"
                                })
                            } else {
                                Toast({
                                    icon: 'error',
                                    title: response.message
                                })
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status == 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(i, val) {
                                    $(`span.text-danger.${i}`).text(val[0])
                                });
                            } else {
                                Toast({
                                    icon: 'error',
                                    title: xhr.responseJSON.message
                                })
                            }
                        },
                        complete: function() {
                            submitButton.html(originalIcon);
                        }
                    });
                });

            }
        }

        $(document).ready(function() {
            app.init();
        })
    </script>
@endpush
