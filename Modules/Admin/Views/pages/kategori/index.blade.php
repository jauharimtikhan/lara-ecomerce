@extends('admin::layout.main', ['title' => 'Kategori'])
@section('content-header')
    <div class="content-header d-flex justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.kategori.index') }}">Kategori</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Kategori</h4>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-sm rounded-10" data-toggle="modal"
                data-target="#modalAddKategori">
                <i data-feather="plus"></i>
                Tambah Kategori
            </button>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body rounded-10">
        <div class="table-responsive ">
            <table class="table  table-bordered table-hover" id="tableKategori">
                <thead>
                    <th></th>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th></th>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalAddKategori" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog"
        aria-labelledby="modalAddKategoriTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddKategoriTitleId">
                        Tambah Kategori
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg></span>
                    </button>
                </div>
                <form method="post" id="formAddKategori">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-groupp">
                                    <label for="name">Nama Kategori</label>
                                    <input type="text" name="name" id="name" class="form-control rounded-10"
                                        placeholder="Masukan Nama Kategori" />
                                    <span class="text-danger name"></span>
                                </div>
                            </div>
                            <div class="col-12 mt-3 float-right">
                                <x-admin-component::mediapicker parent="modalAddKategori" id="selectedMedia"
                                    name="media" />
                                <span class="text-danger media"></span>
                                <span class="text-danger">*Hanya bisa memilih satu gambar</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-10">
                            <i data-feather="send"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditKategori" tabindex="-2" data-backdrop="static" data-keyboard="false"
        role="dialog" aria-labelledby="modalEditKategoriTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditKategoriTitleId">
                        Edit Kategori
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg></span>
                    </button>
                </div>
                <form method="post" id="formEditKategori">
                    @csrf
                    <input type="hidden" name="idedit" id="idedit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-groupp">
                                    <label for="name">Nama Kategori</label>
                                    <input type="text" name="namedit" id="namedit" class="form-control rounded-10"
                                        placeholder="Masukan Nama Kategori" />
                                    <span class="text-danger name"></span>
                                </div>
                            </div>
                            <div class="col-12 mt-3 float-right">
                                <x-admin-component::mediapicker parent="modalEditKategori" id="selectedMediaEdit"
                                    name="mediaedit" />
                                <span class="text-danger mediaedit"></span>
                                <span class="text-danger">*Hanya bisa memilih satu gambar</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-10">
                            <i data-feather="send"></i> Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        let table;
        $(document).ready(function() {
            $('#mnKategori').addClass('active');
            table = $('#tableKategori').DataTable({
                responsive: true,
                stateSave: true,
                pageLength: 5,
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [5, 10, 25, 50],
                            text: '_MENU_ Jumlah Per Halaman ',
                            default: 5
                        },
                        div: {
                            html: `
                           <div class="d-flex align-items-center justify-content-start">
                                <a style="font-size: 1.2em; width: 10%; height: 40px; " role="button" data-url="{{ route('admin.kategori.bulkdelete') }}" class="fs-sm text-danger" data-rows="[]" id="bulkDeleteButton" onclick="stateHandlingSelectedRows(this)">
                                    <i data-feather="trash-2" style="font-size: 1.2em;"></i>
                                </a>
                            </div>
                            `
                        }
                    },
                    bottomStart: {
                        info: {
                            text: "Menampilkan data kategori: _START_ sampai _END_ dari _TOTAL_ Data",
                            empty: "Tidak ada data"
                        },

                    },
                    bottomEnd: {
                        paging: {
                            type: 'full_numbers',
                        }
                    }
                },
                language: {
                    searchPlaceholder: 'Cari...',
                    sSearch: ''
                },
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                ajax: {
                    url: "{{ route('admin.kategori.data') }}",
                    dataSrc: "data"
                },
                columns: [{
                        data: null,
                        render: DataTable.render.select()
                    },
                    {
                        data: 'no'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'media',
                        render: function(data, type, row) {
                            return `
                                    <img class="thumbnail-img" src="${row.media}" alt="gambar kategori ${row.name}"/>    
                                    `
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            let id = row.id;
                            let btn = `
                                            <a role="button" class="text-dark" data-toggle="dropdown">
                                                <i data-feather="more-vertical" data-toggle="tooltip" data-placement="bottom" title="Aksi"></i>
                                            </a>
                                            <div class="dropdown-menu tx-14" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item" data-id="${id}" onclick="editData(this)">Edit</button>
                                                <button class="dropdown-item" type="button" data-id="${id}" onclick="deleteData(this)">Hapus</button>
                                            </div>
                                        `;
                            return btn;
                        }
                    }
                ]
            });
            $('input#dt-search-0.dt-input').focus();
            table.on('draw.dt', function() {
                feather.replace();
            });

            $('#tableKategori').on('select.dt deselect.dt', function(e, dt, type, indexes) {
                if (type === 'row') {
                    const selectedData = dt.rows({
                        selected: true
                    }).data().toArray();
                    let data = selectedData.map(row => row.id);
                    $('#bulkDeleteButton').attr('data-rows', JSON.stringify(data));
                }
            });
        })
        $('#formAddKategori').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.kategori.store') }}",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.status == 201) {
                        $('#modalAddKategori').modal('hide');
                        table.ajax.reload();
                        $('#formAddKategori')[0].reset();
                        Toast({
                            title: response.message,
                            icon: 'success'
                        });
                    } else {
                        Toast({
                            title: response.message,
                            icon: 'error'
                        });
                    }
                },
                error: function(err) {
                    if (err.status == 422) {
                        let errors = err.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $(`span.text-danger.${key}`).text(value[
                                0])
                        });
                    } else {
                        Toast({
                            title: err.responseJSON.message,
                            icon: 'error'
                        })
                    }
                }
            })
        });

        function editData(el) {
            let id = $(el).data('id');
            $.ajax({
                url: "{{ route('admin.kategori.edit', ':id') }}".replace(':id', id),
                method: 'GET',
                success: function(res) {
                    $('#modalEditKategori').modal('show');
                    $('#namedit').val(res.data.name);
                    $('#idedit').val(res.data.id);
                    $('#selectedMediaEdit').empty();
                    $('#preview-selectedMediaEdit').find('p').remove();
                    $('#preview-selectedMediaEdit').append(
                        $('<img/>').attr('src', res.data.media.url).addClass('img-fluid').attr('width',
                            '150').attr('height', '150')
                    );
                },
                error: function(err) {
                    console.log(err);
                }
            });

        }

        $('#formEditKategori').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.kategori.update', ':id') }}".replace(':id',
                    id),
                method: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    if (res.status == 201) {
                        $('#modalEditKategori').modal('hide');
                        table.ajax.reload();
                        Toast({
                            title: res.message,
                            icon: 'success'
                        });
                    } else {
                        Toast({
                            title: res.message,
                            icon: 'error'
                        });

                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        function deleteData(el) {
            let id = $(el).data('id');
            AlertConfirmation({
                title: "Apakah Anda Yakin?",
                text: "Data akan dihapus secara permanen.",
                icon: "warning",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Tidak, Batalkan!",
            }, function() {
                $.ajax({
                    url: "{{ route('admin.kategori.destroy', ':id') }}".replace(':id', id),
                    method: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            table.ajax.reload();
                            Toast({
                                title: res.message,
                                icon: 'success'
                            })
                        } else {
                            Toast({
                                title: res.message,
                                icon: 'error'
                            })
                        }
                    },
                    error: function(err) {
                        if (err.status == 500) {
                            Toast({
                                title: "Server error occurred.",
                                icon: 'error'
                            })
                        }
                    }
                });
            });
        }
    </script>
@endpush
