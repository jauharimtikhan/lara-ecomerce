@extends('admin::layout.main', ['title' => 'Daftar Member'])
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
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Member</h4>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm rounded-10">
                <i data-feather="plus"></i>
                Tambah Member
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body rounded-10">
        <div class="table-responsive ">
            <table class="table  table-bordered table-hover" id="tableUser">
                <thead>
                    <th></th>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar Pada</th>
                    <th></th>
                </thead>
            </table>
        </div>

    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#mnUser').addClass('active');
        var app = {
            tableName: "#tableUser",
            table: null,
            init: function() {
                this.table = $(this.tableName).DataTable({
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
                                        <a style="font-size: 1.2em; width: 10%; height: 40px; " role="button" class="fs-sm text-danger" data-rows="[]" id="bulkDeleteButton" onclick="stateHandlingSelectedRows(this)">
                                            <i data-feather="trash-2" style="font-size: 1.2em;"></i>
                                        </a>
                                    </div>
                                     `
                            }
                        },
                        bottomStart: {
                            info: {
                                text: "Menampilkan data member: _START_ sampai _END_ dari _TOTAL_ Data",
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
                        url: "{{ route('admin.user.all') }}",
                        dataSrc: 'data'
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
                            data: 'email'
                        },
                        {
                            data: 'role[0]'
                        },
                        {
                            data: 'created_at'
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                let id = row.id;
                                let urlEdit = "{{ route('admin.user.show', ':id') }}".replace(':id',
                                    id);
                                let btn = `
                        <a role="button" class="text-dark" data-toggle="dropdown">
                            <i data-feather="more-vertical" data-toggle="tooltip" data-placement="bottom" title="Aksi"></i>
                        </a>
                        <div class="dropdown-menu tx-14" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="${urlEdit}">Edit</a>
                            <button class="dropdown-item" type="button" data-id="${id}" onclick="app.deleteData(this)">Hapus</button>
                        </div>
                    `;
                                return btn;
                            }
                        }
                    ],
                });

                // Event to render feather icons after table redraw
                this.table.on('draw.dt', function() {
                    feather.replace();
                });

                $(this.tableName).on('select.dt deselect.dt', function(e, dt, type, indexes) {
                    if (type === 'row') {
                        const selectedData = dt.rows({
                            selected: true
                        }).data().toArray();
                        let data = selectedData.map(row => row.id);
                        $('#bulkDeleteButton').attr('data-rows', JSON.stringify(data));
                    }
                });
            },
            loadTable: function() {
                this.table.ajax.reload();
            },
            stateHandlingSelectedRows: function(el) {
                let rawData = $(el).attr('data-rows');
                let data = rawData ? JSON.parse(rawData) : [];

                if (data.length > 0) {
                    let message = data.length > 1 ?
                        "Semua data yang dipilih akan dihapus secara permanen." :
                        "Data yang dipilih akan dihapus secara permanen.";

                    AlertConfirmation({
                        title: "Apakah Anda Yakin?",
                        text: message,
                        icon: "warning",
                        confirmButtonText: "Ya, Hapus",
                        cancelButtonText: "Tidak, Batalkan!"
                    }, function() {
                        $.ajax({
                            url: "{{ route('admin.user.bulkdelete') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                rows: JSON.stringify(data)
                            },
                            success: function(res) {
                                if (res.status == 200) {
                                    app.loadTable();
                                    Toast({
                                        icon: 'success',
                                        title: res.message
                                    })
                                }
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        });
                    });
                } else {
                    Toast({
                        icon: 'warning',
                        title: "Tidak ada data yang dipilih",
                    });
                }
            },
            deleteData: function(el) {
                let id = $(el).data('id');
                AlertConfirmation({
                    title: "Apakah Anda Yakin?",
                    text: "Data akan dihapus secara permanen.",
                    icon: "warning",
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Tidak, Batalkan!"
                }, function() {
                    $.ajax({
                        url: "{{ route('admin.user.destroy', ':id') }}".replace(':id', id),
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status === 200) {
                                app.loadTable();
                                Toast({
                                    icon: 'success',
                                    title: res.message
                                })
                            } else {
                                Toast({
                                    icon: 'error',
                                    title: res.message
                                });
                            }
                        },
                        error: function(err) {
                            if (err.status === 500) {
                                Toast({
                                    icon: 'error',
                                    title: "Server error occurred."
                                });
                            }
                        }
                    });
                });
            }
        };




        $(document).ready(function() {
            app.init();
            $('input#dt-search-0.dt-input').focus();
        });
    </script>
@endpush
