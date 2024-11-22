@extends('admin::layout.main', ['title' => 'Sub Kategori'])
@section('content-header')
    <div class="content-header d-flex justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.subkategori.index') }}">Sub Kategori</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Sub Kategori</h4>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-sm rounded-10" data-toggle="modal"
                data-target="#modalAddSubKategori">
                <i data-feather="plus"></i>
                Tambah Sub Kategori
            </button>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body rounded-10">
        <div class="table-responsive ">
            <table class="table  table-bordered table-hover" id="tableSubKategori">
                <thead>
                    <th></th>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th></th>
                </thead>
            </table>
        </div>
    </div>

    {{-- Modal Add Sub Kategori --}}
    <div class="modal fade" id="modalAddSubKategori" tabindex="-1" data-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalAddSubKategoriTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Tambah Sub Kategori
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
                <form action="{{ route('admin.subkategori.store') }}" method="post" id="formAddSubKategori">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namasubkategori">Nama Sub Kategori</label>
                            <input type="text" name="nama_sub_kategori" id="namasubkategori"
                                placeholder="Masukan Nama Sub Kategori" class="form-control rounded-10" />
                            <span class="text-danger nama_sub_kategori"></span>
                        </div>
                        <div class="form-group">
                            <label for="namakategori">Kategori</label>
                            <select name="kategori" id="namakategori" class="form-control rounded-10 select2"></select>
                            <span class="text-danger kategori"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-10">
                            <i data-feather="send"></i> Tambah Sub Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Sub Kategori --}}
    <div class="modal fade" id="modalEditSubKategori" tabindex="-1" data-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalAddSubKategoriTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Edit Sub Kategori
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
                <form action="" method="post" id="formEditSubKategori">
                    @csrf
                    <input type="hidden" name="idedit" id="idedit">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namasubkategoriedit">Nama Sub Kategori</label>
                            <input type="text" name="nama_sub_kategori" id="namasubkategoriedit"
                                placeholder="Masukan Nama Sub Kategori" class="form-control rounded-10" />
                            <span class="text-danger nama_sub_kategori"></span>
                        </div>
                        <div class="form-group">
                            <label for="namakategoriedit">Kategori</label>
                            <select name="kategori" id="namakategoriedit"
                                class="form-control rounded-10 select2"></select>
                            <span class="text-danger kategori"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-10">
                            <i data-feather="send"></i> Edit Sub Kategori
                        </button>
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
            $('#mnSubkategori').addClass('active');

            table = $('#tableSubKategori').DataTable({
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
                                <a style="font-size: 1.2em; width: 10%; height: 40px; " data-url="${$.route('admin.subkategori.bulkdelete')}" role="button" class="fs-sm text-danger" data-rows="[]" id="bulkDeleteButton" onclick="stateHandlingSelectedRows(this)">
                                    <i data-feather="trash-2" style="font-size: 1.2em;"></i>
                                </a>
                            </div>
                            `
                        }
                    },
                    bottomStart: {
                        info: {
                            text: "Menampilkan data sub kategori: _START_ sampai _END_ dari _TOTAL_ Data",
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
                    url: $.route('admin.subkategori.data'),
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
                        data: 'nama_kategori'
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
                                                <button class="dropdown-item" type="button" data-id="${id}" data-type="edit">Edit</button>
                                                <button class="dropdown-item" type="button" data-id="${id}" data-type="delete">Hapus</button>
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

            $('#tableSubKategori').on('select.dt deselect.dt', function(e, dt, type, indexes) {
                if (type === 'row') {
                    const selectedData = dt.rows({
                        selected: true
                    }).data().toArray();
                    let data = selectedData.map(row => row.id);
                    $('#bulkDeleteButton').attr('data-rows', JSON.stringify(data));
                }
            });
            $('#modalAddSubKategori').on('shown.bs.modal', function() {
                $('.select2').select2({
                    placeholder: 'Pilih Salah Satu',
                    searchInputPlaceholder: 'Cari Role',
                    data: getCategories(),
                    dropdownParent: $('#modalAddSubKategori')
                });

                $('#formAddSubKategori').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res.status == 201) {
                                table.ajax.reload();
                                $('#modalAddSubKategori').modal('hide');
                                Toast({
                                    icon: 'success',
                                    title: res.message
                                })
                            } else {
                                Toast({
                                    icon: 'error',
                                    title: res.message
                                })
                            }
                        },
                        error: function(err) {
                            if (err.status == 422) {
                                $('span.text-danger').empty();
                                $.each(err.responseJSON.errors, function(key, item) {
                                    $(`span.text-danger.${key}`).text(item[0]);
                                })
                            } else {
                                Toast({
                                    icon: 'error',
                                    title: err.responseJSON.message
                                })
                            }
                        }
                    })
                })
            });

            $(document).on('click', '.dropdown-item', function() {
                var id = $(this).data('id');
                var type = $(this).data('type');
                if (type == 'delete') {
                    AlertConfirmation({
                        title: "Apakah Anda Yakin?",
                        text: "Data akan dihapus secara permanen.",
                        icon: "warning",
                        confirmButtonText: "Ya, Hapus",
                        cancelButtonText: "Tidak, Batalkan!",
                    }, function() {
                        $.ajax({
                            url: $.route('admin.subkategori.destroy', {
                                subkategori: id
                            }),
                            method: 'DELETE',
                            success: function(res) {
                                if (res.status == 200) {
                                    Toast({
                                        icon: 'success',
                                        title: res.message
                                    });
                                    table.ajax.reload();
                                } else {
                                    Toast({
                                        icon: 'error',
                                        title: res.message
                                    });
                                }
                            },
                            error: function(err) {
                                if (err.responseJSON.message) {
                                    Toast({
                                        icon: 'error',
                                        title: err.responseJSON.message
                                    })
                                }
                            }
                        });
                    });
                } else if (type == 'edit') {
                    $.ajax({
                        url: $.route('admin.subkategori.show', {
                            subkategori: id
                        }),
                        method: 'GET',
                        success: function(res) {
                            $('#modalEditSubKategori').modal('show');
                            $('#modalEditSubKategori').on('shown.bs.modal', function() {
                                $('#idedit').val(res.data.id);
                                $('#namasubkategoriedit').val(res.data.name);
                                $('#namakategoriedit').select2({
                                    placeholder: 'Pilih Salah Satu',
                                    searchInputPlaceholder: 'Cari Kategori',
                                    data: getCategories(),
                                    dropdownParent: $('#modalEditSubKategori'),
                                });
                                $('#namakategoriedit').val(res.data.category_id)
                                    .trigger('change');
                            });

                            $('#formEditSubKategori').submit(function(e) {
                                e.preventDefault();
                                updateData(res.data.id, {
                                    name: $('#namasubkategoriedit').val(),
                                    kategori: $('#namakategoriedit').find(
                                            ':selected')
                                        .val(),
                                });
                            })


                        },
                        error: function(err) {
                            Toast({
                                icon: 'error',
                                title: err.responseJSON.message
                            })
                        }
                    })
                }
            });
        });


        function updateData(id, data) {
            $.ajax({
                url: $.route('admin.subkategori.update', {
                    subkategori: id
                }),
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    name: data.name,
                    kategori: data.kategori
                },
                success: function(res) {
                    if (res.status == 201) {
                        table.ajax.reload();
                        Toast({
                            icon: 'success',
                            title: 'Data Berhasil Diupdate!'
                        });
                        $('#modalEditSubKategori').modal('hide');
                    } else {
                        Toast({
                            icon: 'error',
                            title: 'Data Gagal Diupdate!'
                        });

                    }
                },
                error: function(err) {
                    if (err.responseJSON.message) {
                        Toast({
                            icon: 'error',
                            title: err.responseJSON.message
                        });
                    }
                }
            })
        }


        function getCategories() {
            let data = [];
            $.each(@json($categories), function(key, item) {
                data.push({
                    id: item.id,
                    text: item.name
                })

            });
            return data;
        }
    </script>
@endpush
