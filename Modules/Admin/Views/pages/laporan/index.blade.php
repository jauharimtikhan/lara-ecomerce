@extends('admin::layout.main', ['title' => 'Laporan'])
@section('content-header')
    <div class="content-header d-flex justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.laporan.index') }}">Laporan</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Laporan</h4>
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
        <table class="table  table-bordered table-hover" id="tableKategori">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Total Transaksi</th>
            </thead>
        </table>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        let table;
        $(document).ready(function() {
            $('#mnLaporan').addClass('active');
            table = $('#tableKategori').DataTable({
                responsive: true,
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
                        },
                        buttons: {
                            options: [
                                'colvis',
                                'excel',
                                'print'
                            ]
                        }
                    },
                    bottomStart: {
                        info: {
                            text: "Menampilkan data laporan: _START_ sampai _END_ dari _TOTAL_ Data",
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

            });
            getData();
        });

        function getData() {
            $.ajax({
                url: $.route('admin.laporan.data'),
                type: 'GET',
                success: function(res) {
                    let dt = []; // Array untuk menampung semua baris data
                    table.clear(); // Bersihkan tabel sebelum menambahkan data baru

                    // Iterasi melalui respons data
                    $.each(res, function(key, item) {
                        // Tambahkan baris data ke array `dt`
                        dt.push([key + 1, item.name, item.status, item.total_transaksi]);
                    });

                    // Tambahkan semua baris data ke dalam DataTable sekaligus
                    table.rows.add(dt).draw();

                },
                error: function(err) {
                    console.log(err);

                }
            })
        }
    </script>
@endpush
