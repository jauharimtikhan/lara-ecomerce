@extends('admin::layout.main', ['title' => 'Produk'])
@section('content-header')
    <div class="content-header d-flex justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.produk.index') }}">Produk</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Produk</h4>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary btn-sm rounded-10">
                <i data-feather="plus"></i>
                Tambah Produk
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body rounded-10">
        <table class="table  table-bordered table-hover" id="tableProduk">
            <thead>
                <th><input type="checkbox" id="selectAll"></th>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Berat</th>
                <th>Gambar Produk</th>
                <th></th>
            </thead>
        </table>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        let table;
        $(document).ready(function() {
            $('#mnProduk').addClass('active');
            table = $('#tableProduk').DataTable({
                responsive: true,
                stateSave: true,
                pageLength: 5,
                searchable: false,
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [5, 10, 25, 50],
                            text: '_MENU_ Jumlah Per Halaman ',
                            default: 5
                        },
                        div: {
                            html: `
                            <div class="container-header-datatable">
                                <div class="dropdown dropup rounded-10">
                                     <a data-message="Hapus Produk" class="item-header-datatable text-danger"  data-toggle="dropdown" role="button">
                                         <i data-feather="trash-2" style="font-size: 1.2em;"></i>
                                     </a>
                                    <div class="dropdown-menu tx-14 rounded-10">
                                    <a class="dropdown-item select-none cursor-pointer" id="bulkDeleteButton" data-rows="[]" onclick="stateHandlingSelectedRows(this)" role="button" data-url="{{ route('admin.produk.bulkDelete') }}">Hapus</a>
                                    <a class="dropdown-item select-none cursor-pointer" role="button" id="bulkPermanentDeleteButton" data-rows="[]" onclick="stateForceDeleteButton(this)" data-url="{{ route('admin.produk.bulkPermanentDelete') }}">Hapus Permanen</a>
                                    </div>
                                </div>
                               
                                <a class="item-header-datatable text-success" data-message="Kembalikan Data Produk Yang Dihapus" role="button" data-rows="[]" id="bulkRestoreButton" onclick="stateHandleBulkRestore(this)">
                                    <i class="fas fa-recycle" style="font-size: 1.6em;"></i>
                                </a>
                                <a class="item-header-datatable text-secondary" data-message="Refresh data" role="button" onclick="table.ajax.reload()">
                                    <i class="fas fa-sync-alt fa-spin" style="font-size: 1.3em;"></i>
                                </a>
                            </div>
                            `
                        }
                    },
                    topEnd: {
                        div: {
                            html: `
                                <div style="display: flex; gap: 1rem; align-items: center; justify-content: space-between;">
                                    <div>
                                        <label for="search" class="form-label">Filter Berdasarkan</label>
                                        <select class="form-control rounded-10" id="filter">
                                            <option hidden>Pilih Filter</option>
                                            <option value="tanggal">Tanggal</option>
                                            <option value="nama">Nama</option>
                                            <option value="Kategori">Kategori</option>
                                            <option value="data_trashed">Data Yang Dihapus</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="search" class="form-label">Cari Produk</label>
                                        <input class="form-control rounded-10" placeholder="Cari Produk..." id="filterInput" />
                                    </div>
                                </div>
                            `
                        },

                    },
                    bottomStart: {
                        info: {
                            text: "Menampilkan data produk: _START_ sampai _END_ dari _TOTAL_ Data",
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
                    sSearch: '',
                    emptyTable: 'Tidak Ada Data!'
                },
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]'
                },
                ajax: {
                    url: $.route('admin.produk.data'),
                    dataSrc: 'data'
                },
                columns: [{
                        data: null,
                        render: function() {
                            return `<input type="checkbox" class="rowCheckbox">`
                        }
                    },
                    {
                        data: 'no'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'category'
                    },
                    {
                        data: 'subcategory'
                    },
                    {
                        data: 'price',
                        render: function(data, type, row) {
                            return formatToRupiah(row.price);
                        }
                    },
                    {
                        data: 'stock'
                    },
                    {
                        data: 'weight'
                    },
                    {
                        data: 'gambar_produk',
                        render: function(data, type, row) {

                            return `<img src="${row.gambar_produk}" width="50">`;
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
                                                <a href="${$.route('admin.produk.show', {produk: id})}" class="dropdown-item">Edit</a>
                                                <button onclick="deleteData(this)" class="dropdown-item" type="button" data-id="${id}" data-type="delete">Hapus</button>
                                            </div>
                                        `;
                            return btn;
                        }
                    }
                ]
            });
            $('#selectAll').on('click', function() {
                var isChecked = $(this).prop('checked');
                $('input.rowCheckbox').prop('checked', isChecked);
            });
            $('input#dt-search-0.dt-input').focus();
            table.on('draw.dt', function() {
                feather.replace();
            });
            table.on('responsive-resize', function() {
                feather.replace();
            })
            table.on('responsive-display', function(e, datatable, row, showHide, update) {
                feather.replace();
            });

            $('#tableProduk').on('select.dt deselect.dt', function(e, dt, type, indexes) {
                if (type === 'row') {
                    const selectedData = dt.rows({
                        selected: true
                    }).data().toArray();
                    let data = selectedData.map(row => row.id);
                    $('#bulkDeleteButton').attr('data-rows', JSON.stringify(data));
                    $('#bulkRestoreButton').attr('data-rows', JSON.stringify(data));
                    $('#bulkPermanentDeleteButton').attr('data-rows', JSON.stringify(data));
                }
            });
            $('#filter').on('change', function() {
                if ($(this).find(':selected').val() == 'data_trashed') {
                    handleSearchingData('data_trashed', null);
                }
            })
            $('#filterInput').on('input', debounce(function(e) {
                let type = $('#filter').find(':selected').val();

                handleSearchingData(type, $(this).val())

            }, 500));

            function handleSearchingData(type, value) {
                $.ajax({
                    url: $.route('admin.produk.search'),
                    method: 'POST',
                    data: {
                        type: type,
                        value: value
                    },
                    success: function(res) {
                        let dt = [];
                        table.clear();
                        $.each(res.data, function(index, value) {
                            dt.push({
                                no: value.no,
                                name: value.name,
                                category: value.category,
                                subcategory: value.subcategory,
                                price: value.price,
                                stock: value.stock,
                                weight: value.weight,
                                gambar_produk: value.gambar_produk,
                                id: value.id
                            });
                        });
                        table.rows.add(dt).draw();

                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }





            function debounce(func, delay) {
                let timeoutId;

                return function(...args) {
                    const context = this;

                    clearTimeout(timeoutId);

                    timeoutId = setTimeout(() => {
                        func.apply(context, args);
                    }, delay);
                };
            }


        });

        function stateForceDeleteButton(el) {
            let url = $(el).data('url');
            let ids = $(el).data('rows');
            AlertConfirmation({
                title: "Apakah Anda Yakin?",
                text: "Data produk akan dihapus secara permanen.",
                icon: "warning",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Tidak, Batalkan!",
            }, function() {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        rows: ids
                    },
                    success: function(res) {
                        table.ajax.reload();
                        Toast({
                            icon: 'success',
                            title: res.message,
                        })
                    },
                    error: function(err) {
                        Toast({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                })
            })
        }

        function deleteData(el) {
            let id = $(el).data('id');

            AlertConfirmation({
                title: "Apakah Anda Yakin?",
                text: "Data produk akan dihapus.",
                icon: "warning",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Tidak, Batalkan!",
            }, function() {
                $.ajax({
                    url: $.route('admin.produk.destroy', {
                        produk: id
                    }),
                    method: 'DELETE',
                    success: function(res) {
                        if (res.status == 201) {
                            Toast({
                                icon: 'success',
                                title: res.message
                            });
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
                            });
                        }
                    }
                })

            })
        }

        function stateHandleBulkRestore(el) {
            let rawData = $(el).attr('data-rows');
            let data = rawData ? JSON.parse(rawData) : [];
            if (data.length > 0) {
                let message = data.length > 1 ?
                    "Semua data yang dipilih akan dikembalikan." :
                    "Data yang dipilih akan dikembalikan.";
                AlertConfirmation({
                    title: "Apakah Anda Yakin?",
                    text: message,
                    icon: "warning",
                    confirmButtonText: "Ya, Kembalikan",
                    cancelButtonText: "Tidak, Batalkan!",
                }, function() {
                    $.ajax({
                        url: $.route('admin.produk.restore'),
                        method: 'POST',
                        data: {
                            rows: JSON.stringify(data)
                        },
                        success: function(res) {
                            table.ajax.reload();
                            Toast({
                                icon: 'success',
                                title: res.message,
                            })
                        },
                        error: function(err) {
                            Toast({
                                icon: 'error',
                                title: err.responseJSON.message
                            })
                        }
                    })
                })
            } else {
                Toast({
                    icon: 'error',
                    title: 'Pilih data terlebih dahulu'
                })
            }

        }
    </script>
@endpush
