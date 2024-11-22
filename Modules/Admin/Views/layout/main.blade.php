<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Meta -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon_io/favicon.ico') }}">

    <title>{{ $title . ' - ' . config('app.name') ?? config('app.name') }}</title>

    <!-- vendor css -->
    <link href="{{ asset('admin') }}/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.1.8/r-3.0.3/sl-2.1.0/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/2.1.0/css/select.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <link href="{{ asset('admin') }}/lib/select2/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin') }}/css/cassie.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/css/skin.two.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/css/custom.css">
    @stack('css')
    <script>
        window.routes = @json(collect(\Route::getRoutes()->getRoutesByName())->mapWithKeys(function ($route, $name) {
                return [$name => $route->uri()];
            }));
    </script>
</head>

<body>

    @include('admin::layout.sidebar')
    <!-- sidebar -->

    <div class="content">
        @include('admin::layout.navbar')
        <!-- header -->
        @yield('content-header')
        <div class="content-body">
            @yield('content')
        </div><!-- content-body -->
    </div><!-- content -->

    <script src="{{ asset('admin/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin') }}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin') }}/lib/feather-icons/feather.min.js"></script>
    <script src="{{ asset('admin') }}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('admin') }}/lib/select2/js/select2.min.js"></script>
    <script src="{{ asset('admin') }}/lib/js-cookie/js.cookie.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.1.8/r-3.0.3/sl-2.1.0/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.js"></script>
    <script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/js/jRoute.js') }}"></script>
    <script src="{{ asset('admin') }}/js/cassie.js"></script>
    <script type="text/javascript">
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $(document).ready(function() {

            NProgress.configure({
                showSpinner: false
            });
            // Menampilkan NProgress saat halaman mulai dimuat
            NProgress.start();

            // Menghentikan NProgress saat halaman selesai dimuat
            $(window).on('load', function() {
                NProgress.done();
            });

            // Menggunakan NProgress pada setiap permintaan AJAX
            $(document).ajaxStart(function() {
                NProgress.start();
            }).ajaxStop(function() {
                NProgress.done();
            });
        });

        const Toaster = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        function Toast(params) {
            return Toaster.fire({
                icon: params.icon,
                title: params.title,

            });
        }

        function AlertConfirmation(params, callback) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success rounded-10",
                    cancelButton: "btn btn-danger mx-1 rounded-10"
                },
                buttonsStyling: false
            });

            return swalWithBootstrapButtons.fire({
                title: params.title,
                text: params.text,
                icon: params.icon,
                showCancelButton: true,
                confirmButtonText: params.confirmButtonText ?? 'Ya',
                cancelButtonText: params.cancelButtonText ?? 'Tidak',
                reverseButtons: true,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Toast({
                        icon: 'error',
                        title: 'Tindakan Dibatalkan!',
                    })
                }
            });
        }

        function stateHandlingSelectedRows(el) {
            let rawData = $(el).attr('data-rows');
            let urlData = $(el).attr('data-url');
            let data = rawData ? JSON.parse(rawData) : [];

            if (data.length > 0) {
                let message = data.length > 1 ?
                    "Semua data yang dipilih akan dihapus." :
                    "Data yang dipilih akan dihapus.";

                AlertConfirmation({
                    title: "Apakah Anda Yakin?",
                    text: message,
                    icon: "warning",
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Tidak, Batalkan!"
                }, function() {
                    $.ajax({
                        url: urlData,
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            rows: JSON.stringify(data)
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                table.ajax.reload();
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
        }
        const formatToRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        };
    </script>
    @stack('js')

</body>

</html>
