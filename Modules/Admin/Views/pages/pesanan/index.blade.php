@extends('admin::layout.main', ['title' => 'Pesanan'])
@section('content-header')
    <div class="content-header d-flex justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.pesanan.index') }}">Pesanan</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Pesanan</h4>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.pesanan.create') }}" class="btn btn-primary btn-sm rounded-10">
                <i data-feather="plus"></i>
                Buat Pesanan Baru
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body rounded-10 mb-3 bg-danger text-white">
        TODO: Fungsionalitas pada halaman ini!!!
    </div>
    <div class="card card-body rounded-10 ">
        <div class="content-body-mail">
            <div class="mail-panel">
                <div class="mail-sidebar">
                    <nav class="nav nav-classic flex-column tx-13 mg-t-20">
                        <a role="button" href="javascript:void(0)" data-type="all"
                            class="nav-link rounded-10 btn-menu-pesanan"><i data-feather="shopping-cart"></i>
                            <span>Semua
                                Pesanan</span> <span class="badge">{{ $all }}</span></a>
                        <a role="button" href="javascript:void(0)" data-type="selesai"
                            class="nav-link rounded-10 btn-menu-pesanan"><i data-feather="check-circle"></i> <span>Pesanan
                                Sukses</span> <span class="badge">{{ $success }}</span></a>
                        <a role="button" href="javascript:void(0)" data-type="settlement"
                            class="nav-link rounded-10 btn-menu-pesanan"><i data-feather="alert-circle"></i> <span>Perlu
                                Dikirim</span> <span class="badge">{{ $perluDikirim }}</span></a>
                        <a role="button" href="javascript:void(0)" data-type="pending"
                            class="nav-link rounded-10 btn-menu-pesanan"><i data-feather="dollar-sign"></i> <span>Menunggu
                                Pembayaran</span>
                            <span class="badge">{{ $pending }}</span></a>
                        <a role="button" href="javascript:void(0)" data-type="expiry"
                            class="nav-link rounded-10 btn-menu-pesanan"><i data-feather="x-circle"></i>
                            <span>Kadaluarsa</span>
                            <span class="badge">{{ $expiry }}</span></a>
                    </nav>
                </div><!-- mail-sidebar -->
                <div id="mailBodyList" class="mail-body rounded-10">
                    <div class="mail-body-header">
                        <h5>Daftar Pesanan
                            <br>
                            <span class="d-none d-lg-inline">{{ $perluDikirim }} pesanan perlu dikirim</span>
                        </h5>
                        <div id="paginationMail"></div>
                    </div><!-- mail-body-header -->
                    <div class="mail-body-content" id="mailBodyContent">
                        <div class="mail-navbar">
                            <div class="d-flex align-items-center">
                                <div class="custom-control custom-checkbox pd-l-15 d-none d-lg-block">
                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                    <label class="custom-control-label" for="checkAll"></label>
                                </div>
                                <div class="tx-14 tx-color-04 mg-lg-l-15">
                                    <div class="dropdown dropup">
                                        <a class="cursor-pointer" role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i data-feather="more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu tx-14" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Hapus Semua</a>
                                            <a class="dropdown-item" href="#">Tandai Sudah Selesai</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a href="javascript:void(0)" class="text-secondary" onclick="getData()"><i
                                        data-feather="rotate-cw"></i></a>
                                <a href="" class="text-danger"><i data-feather="trash-2"></i></a>
                            </div>
                        </div><!-- mail-navbar -->
                        <ul class="mail-list">
                            <li class="mail-item unread" id="loader">
                                <div class="mail-item-body d-flex justify-content-center">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </li>
                        </ul>
                    </div><!-- mail-body-content -->
                </div><!-- mail-body -->
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mnPesanan').addClass('active');
            new PerfectScrollbar('.mail-list', {
                suppressScrollX: true
            });

            $('#checkAll').on('change', function(e) {
                if ($(this).is(':checked')) {
                    $('.mail-item').addClass('selected');
                    $('.mail-item .custom-checkbox input').prop('checked', true);

                    let id = $('.mail-item .custom-checkbox input');
                    console.log(id.data('transaction_id'));
                } else {
                    $('.mail-item').removeClass('selected');
                    $('.mail-item .custom-checkbox input').prop('checked', false);
                }
            })

            $('.mail-item .custom-checkbox input').on('change', function(e) {
                if ($(this).is(':checked')) {
                    $(this).closest('.mail-item').addClass('selected');
                } else {
                    $(this).closest('.mail-item').removeClass('selected');
                }
            });

            getData();


            $('.btn-menu-pesanan').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('type');

                getData(id);

            })
        });

        function getData(type = 'all') {
            $('.btn-menu-pesanan').removeClass('active');
            $('.btn-menu-pesanan[data-type="' + type + '"]').addClass('active');
            $.ajax({
                url: $.route('admin.pesanan.data', {
                    pesanan: type
                }),
                method: 'GET',
                success: function(res) {

                    const color = ['teal', 'primary', 'secondary', 'success', 'warning', 'danger', 'indigo',
                        'purple', 'pink'
                    ];
                    const shuffledColors = shuffleArray([...color]);
                    $('.mail-list').html('');
                    if (res.data.length !== 0) {
                        $.each(res.data, function(key, item) {

                            $('#mail-body-' + item.id).html('');
                            let name = item.nama_user;
                            let status = item.status;
                            let message = '';
                            if (status == 'settlement') {
                                status = 'Perlu Dikirim';
                                message = 'Ada pesanan yang perlu dikirim untuk ' + item.nama_user;
                            } else if (status == 'pending') {
                                status = 'Menunggu Pembayaran';
                                message = 'Ada pesanan baru sedang menunggu pembayaran dari ' + item
                                    .nama_user;
                            } else if (status == 'expiry') {
                                status = 'Kadaluarsa';
                                message = 'Ada pesanan kadaluarsa dari ' + item.nama_user;
                            } else {
                                status = 'Selesai';
                                message = 'Pesanan sudah selesai dari ' + item.nama_user;
                            }
                            let html = `
                             <li class="mail-item ${item.status == 'pending' ? 'unread' : ''}">
                                <div class="custom-control custom-checkbox pd-l-15" style="z-index: 9999999">
                                    <input type="checkbox"  data-transaction_id="${item.transaction_id}" class="custom-control-input" id="mail-${item.id}">
                                    <label class="custom-control-label" for="mail-${item.id}"></label>
                                </div>
                               <div class="avatar  mail-item-${item.id}"><span class="avatar-initial rounded-circle bg-${shuffledColors[key]}">${name[0]}</span></div>
                                <div class="mail-item-body  mail-item-${item.id}">
                                    <div>
                                        <span class="text-muted">${item.email_user}</span>
                                        <span>${item.created_at}</span>
                                    </div>
                                    <h6>${message}</h6>
                                    <p>${status}. Total : ${item.quantity}</p>
                                </div>
                            </li>
                            `;
                            $('.mail-list').append(html);
                            $('.mail-item-' + item.id).on('click', function(e) {
                                $('#mail-body-' + item.id).removeClass('d-none');
                                $('#mailBodyList').addClass('d-none');

                                if (window.matchMedia('(max-width: 767px)').matches) {
                                    $('body').removeClass('mail-menu-show');
                                    $('#mailMenu').removeClass('d-none');
                                    $('#mainMenu').addClass('d-none');
                                }
                                let id = $(this).data('transaction_id');
                                if (id !== undefined && id !== null && id !== '') {
                                    e.preventDefault();
                                    getMidtransStatusData(id, item);
                                } else {
                                    e.preventDefault();
                                    getMidtransStatusData(null, item);
                                }

                            });

                            // Event untuk kembali ke daftar email

                            let mailBodyHtml = `
                                            <div>
                                                <div class="mail-body-header">
                                                    <a href="javascript:void(0)" role="button" id="back-${item.id}" class="btn pd-0"><i data-feather="arrow-left"></i> Kembali</a>
                                                    
                                                </div>
                                                <div class="mail-body-content">
                                                    <div class="mail-navbar">
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mail-from">${item.nama_user} <span class="d-none d-sm-inline">${item.email_user}</span></h6>
                                                        </div>
                                                        <div>
                                                            <span role="button" class="cursor-pointer select-none d-inline"><i data-feather="printer"></i></span>
                                                            <span role="button" class="cursor-pointer select-none d-inline"><i data-feather="trash"></i></span>
                                                            <span role="button" class="cursor-pointer select-none d-inline"><i data-feather="more-vertical"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="" id="mail-msg-${item.id}">
                                                        <div id="loader-${item.id}" class="d-flex justify-content-center"><i class="fas fa-spinner fa-spin"></i></div>
                                                    </div>
                                                </div>    
                                            </div>
                                        `;

                            const div = document.querySelector('.mail-panel');
                            const mailBody = document.createElement('div');
                            mailBody.classList.add('mail-body');
                            mailBody.classList.add('d-none');
                            mailBody.setAttribute('id', 'mail-body-' + item.id);
                            mailBody.style.overflow = 'auto';
                            mailBody.style.height = "calc(100% - 50px)";
                            var style = document.createElement('style');
                            style.innerHTML = `
                                            #mail-body-${item.id}::-webkit-scrollbar {
                                                width: 12px; /* Lebar scrollbar */
                                            }

                                            #mail-body-${item.id}::-webkit-scrollbar-thumb {
                                                background-color: #888; /* Warna scrollbar */
                                                border-radius: 6px; /* Membuat tepi scrollbar lebih bulat */
                                                border: 3px solid #fff; /* Border di sekitar scrollbar */
                                            }

                                            #mail-body-${item.id}::-webkit-scrollbar-thumb:hover {
                                                background-color: #555; /* Warna saat hover */
                                            }

                                            #mail-body-${item.id}::-webkit-scrollbar-track {
                                                background: #f1f1f1; /* Warna track scrollbar */
                                                border-radius: 10px;
                                            }
                                            `;
                            document.head.appendChild(style);
                            div.appendChild(mailBody);

                            $('#mail-body-' + item.id).append(mailBodyHtml);
                            $('#back-' + item.id).on('click', function(e) {
                                e.preventDefault();
                                $('#mail-body-' + item.id).addClass('d-none');
                                $('#mailBodyList').removeClass('d-none');

                                if (window.matchMedia('(max-width: 767px)').matches) {
                                    $('body').removeClass('mail-menu-show');
                                    $('#mailMenu').removeClass('d-none');
                                    $('#mainMenu').addClass('d-none');
                                }
                            });


                        });
                    } else {
                        let html = `
                             <li class="mail-item>
                                <div class="custom-control custom-checkbox pd-l-15" style="z-index: 9999999">
                                    <input type="checkbox" class="custom-control-input" id="mail-isNull">
                                    <label class="custom-control-label" for="mail-isNull"></label>
                                </div>
                                <div class="mail-item-body">
                                    <div class="d-flex align-items-center justify-content-center text-center">
                                        <h5 class="text-muted">Tidak ada data pesanan</h5>
                                    </div>
                                </div>
                            </li>
                            `;
                        $('.mail-list').append(html);
                    }

                    $('#paginationMail').html('');
                    let paginationHtml = `
                            <span class="text-muted tx-13 mg-r-10 d-none d-lg-inline">${res.current_page}-${res.per_page} dari ${res.total_item}</span>
                            <div class="d-inline" id="paginationMailItem"></div>
                            `;

                    $('#paginationMail').append(paginationHtml);

                    $.each(res.links, function(key, item) {
                        if (item.label == '&laquo; Previous' && item.url == null) {
                            $('#paginationMailItem').append(`
                                <button class="btn btn-icon btn-xs btn-white rounded-10 pagination-controls" ${item.active ? 'disabled' : ''} data-page="${item.url}"><i data-feather="chevron-left"></i></button>
                                    `);
                        } else if (item.label == 'Next &raquo;') {
                            $('#paginationMailItem').append(`
                                <button class="btn btn-icon btn-xs btn-white rounded-10 pagination-controls" data-page="${item.url}"><i data-feather="chevron-right"></i></button>
                                    `);
                        } else {
                            $('#paginationMailItem').append(`
                                <button class="btn btn-icon btn-xs btn-white rounded-10 ${item.active ? 'active' : ''}  pagination-controls" data-page="${item.url}">${item.label}</button>
                                    `);
                        }
                    });

                    $('.pagination-controls').on('click', function(e) {
                        e.preventDefault();
                        let page = $(this).data('page');
                        if (page == null) {
                            return;
                        }
                        loadMail(page);
                    });

                    feather.replace();

                },
                complete: function() {
                    $('#loader').remove();
                },
                error: function(err) {
                    console.log(err);

                }
            })
        }

        function loadMail(page) {
            $.ajax({
                type: 'GET',
                url: page,
                beforeSend: function() {
                    const loaderContainer = document.createElement('div');
                    loaderContainer.classList.add('d-flex', 'justify-content-center');
                    loaderContainer.id = 'loader';
                    const loader = document.createElement('span');
                    const iconLoader = document.createElement('i');
                    iconLoader.classList.add('fas', 'fa-spinner', 'fa-spin');
                    loader.appendChild(iconLoader);
                    loader.textContent = 'Loading...';
                    loaderContainer.appendChild(loader);
                    $('.mail-list').html(loaderContainer);
                },
                success: function(res) {
                    // mailList.html(res);
                    const color = ['teal', 'primary', 'secondary', 'success', 'warning', 'danger', 'indigo',
                        'purple', 'pink'
                    ];
                    const shuffledColors = shuffleArray([...color]);
                    $('.mail-list').html('');
                    $.each(res.data, function(key, item) {
                        $('#mail-body-' + item.id).html('');
                        let name = item.nama_user;
                        let status = item.status;
                        let message = '';
                        if (status == 'settlement') {
                            status = 'Perlu Dikirim';
                            message = 'Ada pesanan yang perlu dikirim untuk ' + item.nama_user;
                        } else if (status == 'pending') {
                            status = 'Menunggu Pembayaran';
                            message = 'Ada pesanan baru sedang menunggu pembayaran dari ' + item
                                .nama_user;
                        } else if (status == 'expiry') {
                            status = 'Kadaluarsa';
                            message = 'Ada pesanan kadaluarsa dari ' + item.nama_user;
                        } else {
                            status = 'Selesai';
                            message = 'Pesanan sudah selesai dari ' + item.nama_user;
                        }
                        let html = `
                             <li class="mail-item ${item.status == 'pending' ? 'unread' : ''}" data-transaction_id="${item.transaction_id}">
                                <div class="custom-control custom-checkbox pd-l-15" style="z-index: 9999999">
                                    <input type="checkbox"  data-transaction_id="${item.transaction_id}" class="custom-control-input" id="mail-${item.id}">
                                    <label class="custom-control-label" for="mail-${item.id}"></label>
                                </div>
                               <div class="avatar  mail-item-${item.id}"><span class="avatar-initial rounded-circle bg-${shuffledColors[key]}">${name[0]}</span></div>
                                <div class="mail-item-body  mail-item-${item.id}">
                                    <div>
                                        <span class="text-muted">${item.email_user}</span>
                                        <span>${item.created_at}</span>
                                    </div>
                                    <h6>${message}</h6>
                                    <p>${status}. Total : ${item.quantity}</p>
                                </div>
                            </li>
                            `;
                        $('.mail-list').append(html);
                        $('.mail-item-' + item.id).on('click', function(e) {
                            $('#mail-body-' + item.id).removeClass('d-none');
                            $('#mailBodyList').addClass('d-none');

                            if (window.matchMedia('(max-width: 767px)').matches) {
                                $('body').removeClass('mail-menu-show');
                                $('#mailMenu').removeClass('d-none');
                                $('#mainMenu').addClass('d-none');
                            }
                            let id = $(this).data('transaction_id');
                            if (id !== undefined && id !== null && id !== '') {
                                e.preventDefault();
                                getMidtransStatusData(id, item);
                            } else {
                                e.preventDefault();
                                getMidtransStatusData(null, item);
                            }

                        });

                        // Event untuk kembali ke daftar email

                        let mailBodyHtml = `
                                            <div>
                                                <div class="mail-body-header">
                                                    <a href="javascript:void(0)" role="button" id="back-${item.id}" class="btn pd-0"><i data-feather="arrow-left"></i> Kembali</a>
                                                   
                                                </div>
                                                <div class="mail-body-content">
                                                    <div class="mail-navbar">
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mail-from">${item.nama_user} <span class="d-none d-sm-inline">${item.email_user}</span></h6>
                                                        </div>
                                                        <div>
                                                            <span role="button" class="cursor-pointer select-none d-inline"><i data-feather="printer"></i></span>
                                                            <span role="button" class="cursor-pointer select-none d-inline"><i data-feather="trash"></i></span>
                                                            <span role="button" class="cursor-pointer select-none d-inline"><i data-feather="more-vertical"></i></span>
                                                        </div>
                                                    </div>
                                                    <div  id="mail-msg-${item.id}">
                                                        <div id="loader-${item.id}" class="d-flex justify-content-center"><i class="fas fa-spinner fa-spin"></i></div>
                                                    </div>
                                                </div>    
                                            </div>
                                        `;

                        const div = document.querySelector('.mail-panel');
                        const mailBody = document.createElement('div');
                        mailBody.classList.add('mail-body');
                        mailBody.classList.add('d-none');
                        mailBody.setAttribute('id', 'mail-body-' + item.id);
                        mailBody.style.overflow = 'auto';
                        mailBody.style.height = "calc(100% - 50px)";
                        var style = document.createElement('style');
                        style.innerHTML = `
                                            #mail-body-${item.id}::-webkit-scrollbar {
                                                width: 12px; /* Lebar scrollbar */
                                            }

                                            #mail-body-${item.id}::-webkit-scrollbar-thumb {
                                                background-color: #888; /* Warna scrollbar */
                                                border-radius: 6px; /* Membuat tepi scrollbar lebih bulat */
                                                border: 3px solid #fff; /* Border di sekitar scrollbar */
                                            }

                                            #mail-body-${item.id}::-webkit-scrollbar-thumb:hover {
                                                background-color: #555; /* Warna saat hover */
                                            }

                                            #mail-body-${item.id}::-webkit-scrollbar-track {
                                                background: #f1f1f1; /* Warna track scrollbar */
                                                border-radius: 10px;
                                            }
                                            `;
                        document.head.appendChild(style);
                        div.appendChild(mailBody);

                        // Menambahkan HTML ke dalam elemen
                        $('#mail-body-' + item.id).append(mailBodyHtml);

                        $('#back-' + item.id).on('click', function(e) {
                            e.preventDefault();
                            $('#mail-body-' + item.id).addClass('d-none');
                            $('#mailBodyList').removeClass('d-none');

                            if (window.matchMedia('(max-width: 767px)').matches) {
                                $('body').removeClass('mail-menu-show');
                                $('#mailMenu').removeClass('d-none');
                                $('#mainMenu').addClass('d-none');
                            }
                        });
                    });
                    $('#paginationMail').html('');
                    let paginationHtml = `
                            <span class="text-muted tx-13 mg-r-10 d-none d-lg-inline">${res.current_page}-${res.per_page} dari ${res.total_item}</span>
                            <div class="d-inline" id="paginationMailItem"></div>
                            `;

                    $('#paginationMail').append(paginationHtml);

                    $.each(res.links, function(key, item) {
                        if (item.label == '&laquo; Previous') {
                            $('#paginationMailItem').append(`
                                <button class="btn btn-icon btn-xs btn-white rounded-10 pagination-controls" ${item.active ? 'disabled' : ''} data-page="${item.url}"><i data-feather="chevron-left"></i></button>
                                    `);
                        } else if (item.label == 'Next &raquo;') {
                            $('#paginationMailItem').append(`
                                <button class="btn btn-icon btn-xs btn-white rounded-10 pagination-controls" data-page="${item.url}"><i data-feather="chevron-right"></i></button>
                                    `);
                        } else {
                            $('#paginationMailItem').append(`
                                <button class="btn btn-icon btn-xs btn-white rounded-10 ${item.active ? 'active' : ''}  pagination-controls" data-page="${item.url}">${item.label}</button>
                                    `);
                        }
                    });

                    $('.pagination-controls').on('click', function(e) {
                        e.preventDefault();
                        let page = $(this).data('page');
                        if (page == null) {
                            return;
                        }
                        loadMail(page);
                    });
                    feather.replace();
                },
                complete: function() {
                    $('#loader').remove();
                },
                error: function(err) {
                    console.log(err);

                }
            })
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function getMidtransStatusData(id, item) {
            if (id == null) {
                $('#loader-' + item.id).remove();
                // $('#mail-body-' + item.id).empty();
                let diskon = 0;
                let html = `
                        <div class="card card-invoice mt-0">
                            <div class="card-header">
                                <div>
                                    <h5 class="mg-b-3">Invoice #${item.id}</h5>
                                    <span class="tx-sm text-muted">Perlu dikirim sebelum: ${item.status == 'expiry' ? '-' : item.tgl_pengiriman}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="content-label">Dari :</label>
                                            <h6 class="tx-15 mg-b-10">{{ config('app.name') }}</h6>
                                            <p class="mg-b-0">  Kwaron, Kec. Diwek, Kabupaten Jombang, Jawa Timur 61471</p>
                                            <p class="mg-b-0">No Telp: 0857-4884-0499</p>
                                            <p class="mg-b-0">Email: {{ Auth::user()->email }}</p>
                                        </div>
                                        <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
                                            <label class="content-label">Kepada :</label>
                                            <h6 class="tx-15 mg-b-10">${item.nama_user}</h6>
                                            <p class="mg-b-0">${item.detail_user.alamat_lengkap}</p>
                                            <p class="mg-b-0">No Telp: ${item.detail_user.notelp}</p>
                                            <p class="mg-b-0">Email: ${item.email_user}</p>
                                        </div>
                                    </div>

                                    <div class="table-responsive mg-t-25">
                                    <table class="table table-invoice bd-b">
                                        <thead>
                                            <tr>
                                                <th class="wd-10p">Gambar Produk</th>
                                                <th class="wd-20p">Nama Produk</th>
                                                <th class="wd-40p d-none d-sm-table-cell">Deskripsi Produk</th>
                                                <th class="tx-center">QNTY</th>
                                                <th class="tx-right">Harga Produk</th>
                                                <th class="tx-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-invoice-produk-${item.id}"></tbody>
                                    </table>
                                    </div>

                                    <div class="row justify-content-between mg-t-25">
                                    <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
                                        <label class="content-label mg-b-10">Catatan Dari Pembeli :</label>
                                        <p class="tx-sm">${item.note == null ? 'Tidak Ada Catatan' : item.note} </p>
                                    </div>
                                        <div class="col-sm-6 col-lg-4 order-1 order-sm-0">
                                            <ul class="list-unstyled lh-7 pd-r-10">
                                            <li class="d-flex justify-content-between">
                                                <span>Sub-Total :</span>
                                                <span>${formatToRupiah(item.total_price)}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <span>Biaya Pengiriman :</span>
                                                <span>${formatToRupiah(item.ongkir)}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <span>Diskon :</span>
                                                <span id="diskon-${item.id}"></span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Total Due</strong>
                                                <strong>${countTotal(item.total_price, item.ongkir)}</strong>
                                            </li>
                                            </ul>
                                            ${item.status == 'expiry' ? '' : '<button class="btn btn-block rounded-10 btn-primary btn-brand-02" onclick="prosesPesanan(this)" data-id="' + item.id + '">Proses Pesanan</button>'}
                                            
                                        </div>
                                    </div>
                            </div>
                        </div>
                    `;
                $('#mail-body-' + item.id).append(html);
                // $('#table-invoice-produk-' + item.id).empty();
                $.each(item.product, function(index, value) {
                    diskon += value.diskon;
                    var html = `
                            <tr>
                                <td class="text-center"><img src="${value.thumbnail}" class="rounded-10" alt="gambar produk ${value.name}" width="30%" height="30%"/></td>
                                <td class="tx-nowrap">${value.name}</td>
                                <td class="d-none d-sm-table-cell tx-color-03">${clearHtmlCode(value.description)}</td>
                                <td class="tx-center">${item.quantity}</td>
                                <td class="tx-right">${formatToRupiah(value.harga_produk)}</td>
                                <td class="tx-right">${formatToRupiah(item.total_price)}</td>
                            </tr>
                        `;

                    $('#table-invoice-produk-' + item.id).append(html);
                });
                $('#diskon-' + item.id).text(formatToRupiah(diskon));
            } else {
                $.ajax({
                    url: $.route('midtrans.status'),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        transaction_id: id
                    },
                    success: function(res) {
                        // $('#mail-body-' + item.id).empty();
                        let diskon = 0;
                        let html = `
                            <div class="card card-invoice mt-0">
                                <div class="card-header">
                                    <div>
                                    <h5 class="mg-b-3">Invoice #${item.transaction_id}</h5>
                                    <span class="tx-sm text-muted">Perlu dikirim sebelum: ${item.status == 'expiry' ? '-' : item.tgl_pengiriman}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="content-label">Dari :</label>
                                                <h6 class="tx-15 mg-b-10">{{ config('app.name') }}</h6>
                                                <p class="mg-b-0">  Kwaron, Kec. Diwek, Kabupaten Jombang, Jawa Timur 61471</p>
                                                <p class="mg-b-0">No Telp: 0857-4884-0499</p>
                                                <p class="mg-b-0">Email: {{ Auth::user()->email }}</p>
                                            </div>
                                            <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
                                                <label class="content-label">Kepada :</label>
                                                <h6 class="tx-15 mg-b-10">${item.nama_user}</h6>
                                                <p class="mg-b-0">${item.detail_user.alamat_lengkap}</p>
                                                <p class="mg-b-0">No Telp: ${item.detail_user.notelp}</p>
                                                <p class="mg-b-0">Email: ${item.email_user}</p>
                                            </div>
                                        </div>
    
                                        <div class="table-responsive mg-t-25">
                                        <table class="table table-invoice bd-b">
                                            <thead>
                                                <tr>
                                                    <th class="wd-10p">Gambar Produk</th>
                                                    <th class="wd-20p">Nama Produk</th>
                                                    <th class="wd-40p d-none d-sm-table-cell">Deskripsi Produk</th>
                                                    <th class="tx-center">QNTY</th>
                                                    <th class="tx-right">Harga Produk</th>
                                                    <th class="tx-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-invoice-produk-${item.id}"></tbody>
                                        </table>
                                        </div>
    
                                        <div class="row justify-content-between mg-t-25">
                                        <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
                                            <label class="content-label mg-b-10">Some Additional Notes</label>
                                            <p class="tx-sm">${item.note == null ? 'Tidak Ada Catatan' : item.note}</p>
                                        </div>
                                            <div class="col-sm-6 col-lg-4 order-1 order-sm-0">
                                                <ul class="list-unstyled lh-7 pd-r-10">
                                                <li class="d-flex justify-content-between">
                                                    <span>Sub-Total</span>
                                                    <span>${formatToRupiah(item.total_price)}</span>
                                                </li>
                                                <li class="d-flex justify-content-between">
                                                    <span>Biaya Pengiriman :</span>
                                                    <span>${formatToRupiah(item.ongkir)}</span>
                                                </li>
                                                <li class="d-flex justify-content-between">
                                                    <span>Diskon :</span>
                                                    <span id="diskon-${item.id}">-</span>
                                                </li>
                                                <li class="d-flex justify-content-between">
                                                    <strong>Total Pesanan</strong>
                                                    <strong>${countTotal(item.total_price, item.ongkir)}</strong>
                                                </li>
                                                </ul>
    
                                                 ${item.status == 'expiry' ? '' : '<button class="btn btn-block rounded-10 btn-primary btn-brand-02" onclick="prosesPesanan(this)" data-id="' + item.id + '">Proses Pesanan</button>'}
                                            </div>
                                        </div>
                                </div>
                            </div>
                        `;

                        $('#mail-body-' + item.id).append(html);
                        $('#table-invoice-produk-' + item.id).empty();
                        $.each(item.product, function(index, value) {
                            diskon += value.diskon;
                            var html = `
                                <tr>
                                    <td class="text-center"><img src="${value.thumbnail}" class="rounded-10" alt="gambar produk ${value.name}" width="30%" height="30%"></td>
                                    <td class="tx-nowrap">${value.name}</td>
                                    <td class="d-none d-sm-table-cell tx-color-03">${clearHtmlCode(value.description)}</td>
                                    <td class="tx-center">${value.qty}</td>
                                    <td class="tx-right">${formatToRupiah(value.harga_produk)}</td>
                                    <td class="tx-right">${formatToRupiah(item.total_price)}</td>
                                </tr>
                            `;

                            $('#table-invoice-produk-' + item.id).append(html);
                        });
                        // console.log(item.product);
                        $('#diskon-' + item.id).text(formatToRupiah(diskon));


                    },
                    complete: function() {
                        $('#loader-' + item.id).remove();
                    },
                    error: function(err) {
                        console.error(err.responseJSON.errors);
                    }
                });
            }

        }

        function clearHtmlCode(input) {
            var dummyDiv = document.createElement('div');
            dummyDiv.innerHTML = input;
            return dummyDiv.textContent || dummyDiv.innerText || '';
        }

        function countTotal(total, ongkir) {
            return formatToRupiah(total + ongkir);
        }

        function prosesPesanan(el) {
            var id = $(el).data('id');
            Toast({
                icon: "info",
                title: "Fitur Dalam Tahap Pengembangan"
            })

        }
    </script>
@endpush
