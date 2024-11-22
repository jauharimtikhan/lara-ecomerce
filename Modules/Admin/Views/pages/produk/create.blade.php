@extends('admin::layout.main', ['title' => 'Tambah Produk'])
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
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Tambah Produk</h4>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary btn-sm rounded-10">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.produk.store') }}" method="post" id="formAddProduk">
        <div class="row">
            <div class="col-8">
                <div class="card card-body rounded-10">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control rounded-10"
                                    placeholder="Masukan Nama Produk" />
                                <span class="text-danger nama_produk"></span>
                            </div>
                            <div class="form-group">
                                <label for="kategori_produk">Kategori Produk</label>
                                <select name="kategori_produk" id="kategori_produk"
                                    class="form-control rounded-10 select2"></select>
                                <span class="text-danger kategori_produk"></span>
                            </div>
                            <div class="form-group">
                                <label for="sub_kategori_produk">Sub Kategori Produk</label>
                                <select name="sub_kategori_produk" id="sub_kategori_produk"
                                    class="form-control rounded-10 select2"></select>
                                <span class="text-danger sub_kategori_produk"></span>
                            </div>
                            <div class="form-group">
                                <label for="harga_produk">Harga Produk</label>
                                <input type="text" name="harga_produk" id="harga_produk" class="form-control rounded-10"
                                    placeholder="Masukan harga Produk" />
                                <span class="text-danger harga_produk"></span>
                            </div>
                            <div class="form-group">
                                <label for="berat_produk">Berat Produk</label>
                                <input type="number" min="1" step="1" name="berat_produk" id="berat_produk"
                                    class="form-control rounded-10" placeholder="Masukan berat Produk" />
                                <span class="text-danger berat_produk"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stok_produk">Stok Produk</label>
                                <input type="number" name="stok_produk" id="stok_produk" class="form-control rounded-10"
                                    placeholder="Masukan stok Produk" />
                                <span class="text-danger stok_produk"></span>
                            </div>
                            <div class="form-group">
                                <label for="size_produk">Variant Size Produk</label>
                                <select name="size_produk" id="size_produk" class="form-control rounded-10"
                                    multiple></select>
                                <span class="text-danger size_produk"></span>
                            </div>
                            <div class="form-group d-flex flex-column" id="color_produk_select2">
                                <label for="warna_produk">Variant Warna Produk</label>
                                <select type="text" name="warna_produk" id="warna_produk" multiple
                                    class="form-control select2"></select>
                                <span class="text-danger warna_produk"></span>
                            </div>
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" checked>
                                <label class="custom-control-label select-none cursor-pointer" for="is_active">Status
                                    Produk
                                    <span class="p-1 text-white rounded-10"></span></label>
                            </div>
                            <div class="custom-control custom-switch mb-3 ">
                                <input type="checkbox" name="is_featured" class="custom-control-input" id="is_featured">
                                <label class="custom-control-label select-none cursor-pointer" for="is_featured">Tampilkan
                                    Produk
                                    <span class="p-1 text-white rounded-10"></span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-body rounded-10">
                    <div class="form-group">
                        <label for="gambar_produk">Gambar Produk</label>
                        <x-dynamic-component :component="$componentGambarProduk" buttonTitle="Pilih Gambar Produk" id="gambar_produk"
                            name="gambar_produk" />
                        <span class="text-danger gambar_produk"></span>
                    </div>
                    <div class="form-group">
                        <label for="galleri_produk">Galleri Produk</label>
                        <x-dynamic-component component="admin-component::mediapicker" buttonTitle="Pilih Galleri Produk"
                            id="galleri_produk" name="galleri_produk" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-body rounded-10 mt-4">
            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk</label>
                <input type="hidden" name="deskripsi_produk" id="deskripsi_produk">
                <div id="editor-container" class="bg-white ht-200"></div>
                <span class="text-danger deskripsi_produk"></span>
            </div>
            <div class="form-group mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm rounded-10">
                    <i data-feather="send"></i>
                    Tambah</button>
            </div>
        </div>
    </form>
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script type="text/javascript">
        let quill;
        const quillToolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],
            ['link', 'image', 'video', 'formula'],

            [{
                'header': 1
            }, {
                'header': 2
            }], // custom button values
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'list': 'check'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // superscript/subscript
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction

            [{
                'size': ['small', false, 'large', 'huge']
            }], // custom dropdown
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],

            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            ['clean'] // remove formatting button
        ];
        let dataSize = [{
                id: 'xxs',
                text: 'XXS'
            },
            {
                id: 'xs',
                text: 'XS'
            },
            {
                id: 's',
                text: 'S'
            },
            {
                id: 'm',
                text: 'M'
            },
            {
                id: 'l',
                text: 'L'
            },
            {
                id: 'xl',
                text: 'XL'
            },
            {
                id: 'xxl',
                text: 'XXL'
            },
            {
                id: 'xxxl',
                text: 'XXXL'
            }
        ];

        let dataWarna = [{
                id: 'biru',
                text: 'BIRU'
            },
            {
                id: 'merah',
                text: 'MERAH'
            },
            {
                id: 'kuning',
                text: 'KUNING'
            },
            {
                id: 'hijau',
                text: 'HIJAU'
            },
        ];
        var getData = {
            category: function() {
                let data = [];
                $.each(@json($categories), function(key, item) {
                    data.push({
                        id: item.id,
                        text: item.name
                    });
                });
                return data;
            },
            subCategory: function() {
                let data = [];
                $.each(@json($subcategories), function(key, item) {
                    data.push({
                        id: item.id,
                        text: item.name
                    });
                });
                return data;
            }
        }


        $(document).ready(function() {
            $('#mnProduk').addClass('active');

            quill = new Quill('#editor-container', {
                modules: {
                    toolbar: quillToolbarOptions
                },
                placeholder: 'Silahkan tulis deskripsi produk Anda',
                theme: 'snow'
            });

            $('#size_produk').select2({
                placeholder: 'Pilih Ukuran',
                data: dataSize,
                tags: true,
                multiple: true
            });
            $('#warna_produk').select2({
                placeholder: 'Pilih Warna',
                data: dataWarna,
                tags: true,
                multiple: true,
                templateSelection: function(data) {
                    if (!data.id) {
                        return data.text;
                    }

                    const isColor = (color) => {
                        const s = new Option().style;
                        s.color = color;
                        return s.color !== '';
                    };
                    let bgColor;
                    let brightNess;

                    $.each($.colorNameIndo, function(key, item) {
                        if (item.name == data.id) {
                            bgColor = item.hex;

                        }
                    });

                    return $(
                        `<div style="display: flex; align-items: center; background-color: ${bgColor}; padding: 0.9rem; height: 12px; width: 20%; border-radius: 5px;">` +
                        `</div>`
                    );
                }
            });

            $('#kategori_produk').select2({
                placeholder: 'Pilih Kategori',
                data: getData.category()
            });

            $('#sub_kategori_produk').select2({
                placeholder: 'Pilih Sub Kategori',
                data: getData.subCategory()
            });

            $('#harga_produk').on('input', function() {

                const inputValue = $(this).val().replace(/[^\d]/g, ''); // Hapus karakter non-numerik
                if (inputValue) {
                    const formatted = formatToRupiah(inputValue);
                    $(this).val(formatted);
                } else {
                    $(this).val('');
                }
            })

            const isActiveToggle = document.getElementById('is_active');
            let badgeIsActive = isActiveToggle.parentElement.querySelector('span');
            if (isActiveToggle.checked) {
                badgeIsActive.classList.add('bg-success');
                badgeIsActive.innerHTML = 'Aktif';
            } else {
                badgeIsActive.classList.add('bg-danger');
                badgeIsActive.innerHTML = 'Tidak Aktif';

            }
            isActiveToggle.addEventListener('change', function() {
                if (isActiveToggle.checked) {
                    badgeIsActive.classList.remove('bg-danger');
                    badgeIsActive.classList.add('bg-success');
                    badgeIsActive.innerHTML = 'Aktif';
                } else {
                    badgeIsActive.classList.remove('bg-success');
                    badgeIsActive.classList.add('bg-danger');
                    badgeIsActive.innerHTML = 'Tidak Aktif';
                }
            });

            const isFeatureToggle = document.getElementById('is_featured');
            let badgeIsFeatured = isFeatureToggle.parentElement.querySelector('span');
            if (isFeatureToggle.checked) {
                badgeIsFeatured.classList.add('bg-success');
                badgeIsFeatured.innerHTML = 'Ya';
            } else {
                badgeIsFeatured.classList.add('bg-danger');
                badgeIsFeatured.innerHTML = 'Tidak';

            }
            isFeatureToggle.addEventListener('change', function() {
                if (isFeatureToggle.checked) {
                    badgeIsFeatured.classList.remove('bg-danger');
                    badgeIsFeatured.classList.add('bg-success');
                    badgeIsFeatured.innerHTML = 'Ya';
                } else {
                    badgeIsFeatured.classList.remove('bg-success');
                    badgeIsFeatured.classList.add('bg-danger');
                    badgeIsFeatured.innerHTML = 'Tidak';
                }
            })

            $('#user_id').val('{{ Auth::user()->id }}').trigger('change');

            $('#formAddProduk').submit(function(e) {
                e.preventDefault();
                const content = quill.root.innerHTML;

                const form = $(this); // Simpan referensi form
                const submitButton = form.find('button[type="submit"]');
                const formData = new FormData();
                formData.append('nama_produk', $('#nama_produk').val());
                formData.append('harga_produk', $('#harga_produk').val());
                formData.append('is_active_produk', isActiveToggle.checked ? 1 : 0);
                formData.append('is_featured_produk', isFeatureToggle.checked ? 1 : 0);
                formData.append('kategori_produk', $('#kategori_produk').val());
                formData.append('sub_kategori_produk', $('#sub_kategori_produk').val());
                formData.append('berat_produk', $('#berat_produk').val());
                formData.append('warna_produk', $('#warna_produk').val());
                formData.append('size_produk', $('#size_produk').val());
                formData.append('stok_produk', $('#stok_produk').val());
                formData.append('user_id', $('#user_id').val());
                formData.append('deskripsi_produk', content);
                formData.append('galleri_produk', $('#input-galleri_produk').val());
                formData.append('gambar_produk', $('#input-gambar_produk').val());


                $.ajax({
                    url: $.route('admin.produk.store'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Ganti ikon submit button dan tampilkan loading state
                        submitButton.html('<i class="fas fa-spinner fa-spin"></i> ');
                        submitButton.attr('disabled', true);
                        submitButton.text('Loading...');
                    },
                    success: function(res) {
                        console.log(res);
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
                    complete: function() {
                        submitButton.html('<i data-feather="send"></i> ');
                        submitButton.attr('disabled', false);
                        submitButton.text('Tambah');
                    },
                    error: function(err) {
                        if (err.status === 422) {
                            const errors = err.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $(`span.text-danger.${key}`).text('');
                                $(`span.text-danger.gambar_produk`).text('');
                                $(`span.text-danger.${key}`).text(value[0]);
                            });
                        } else {
                            Toast({
                                icon: 'error',
                                title: err.responseJSON.message
                            });
                        }
                    }
                });
            });

        });
    </script>
@endpush
