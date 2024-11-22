@extends('admin::layout.main', ['title' => 'Tampilan'])
@section('content-header')
    <div class="content-header d-flex justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.tampilan.index') }}">Tampilan</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="content-title content-title-xs">Tampilan</h4>
        </div>
        <div class="d-flex justify-content-end" id="btnUpdateTampilan">
            <button type="button" class="btn btn-primary rounded-10 btn-sm" data-toggle="modal"
                data-target="#modalUpdateTampilanBanner">Edit Tampilan Banner</button>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body rounded-10 mb-3 bg-danger text-white">
        TODO: Fungsionalitas pada halaman ini!!!
    </div>
    {{-- @dd($datas) --}}
    <div class="card card-body rounded-10">
        <ul class="nav nav-tabs nav-justified" id="myTab3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="banner-tab3" data-toggle="tab" href="#banner3" role="tab"
                    aria-controls="banner" aria-selected="true">Banner Utama</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="kategori-tab3" data-toggle="tab" href="#kategori" role="tab"
                    aria-controls="kategori" aria-selected="false">Kategori</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="flash-sale-tab3" data-toggle="tab" href="#flash-sale" role="tab"
                    aria-controls="flash-sale" aria-selected="false">Flash Sale</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="footer-tab3" data-toggle="tab" href="#footer" role="tab" aria-controls="footer"
                    aria-selected="false">Footer</a>
            </li>
        </ul>
        <div class="tab-content bd bg-white bd-t-0 pd-20" id="myTabContent3">
            <div class="tab-pane fade show active" id="banner3" role="tabpanel" aria-labelledby="banner-tab3">
                <h6>Banner</h6>
                <div class="row">
                    @foreach ($banner as $ban)
                        <div class="col-4">
                            <div class=" rounded-10" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25))">
                                <img src="{{ $ban }}" alt="" class="img-fluid rounded-10">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="kategori" role="tabpanel" aria-labelledby="kaetgori-tab3">
                <h6>Kategori</h6>
                <div class="row">
                    @foreach ($kategoris->CategoryBanner() as $ban)
                        <div class="col-4">
                            <div class=" rounded-10" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25))">
                                <img src="{{ $ban['url'] }}" alt="" class="img-fluid rounded-10">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="flash-sale" role="tabpanel" aria-labelledby="flash-sale-tab3">
                <h6>Flash Sale</h6>
                <div class="row">
                    <div class="col-4">
                        <div class=" rounded-10" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25))">
                            <img src="{{ $kategoris->Ads()['banner'] }}" alt="" class="img-fluid rounded-10">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer">
                <h6>Footer</h6>
                <p class="mg-b-0">{!! str($kategoris->home_footer)->sanitizeHtml() !!}</p>
            </div>
        </div>
    </div>

    {{-- Modal Update Tampilan Banner --}}
    <div class="modal fade" id="modalUpdateTampilanBanner" tabindex="-1" data-backdrop="static" data-keyboard="false"
        role="dialog" aria-labelledby="modalTitleBannerId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleBannerId">
                        Edit Tampilan Banner Utama
                    </h5>
                    <button type="button" class="btn btn-white rounded-lg btn-sm" data-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>
                <form method="post" id="formUpdateTampilanBanner">
                    @csrf
                    <div class="modal-body">
                        <x-dynamic-component component="admin-component::mediapicker" buttonTitle="Pilih Gambar Banner"
                            id="banner" name="banner" name="banner" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-10">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Update Tampilan Kategori --}}
    <div class="modal fade" id="modalUpdateTampilanKategori" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modalTitleKategoriId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleKategoriId">
                        Edit Tampilan Kategori
                    </h5>
                    <button type="button" class="btn btn-white rounded-lg btn-sm" data-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>
                <form method="post" id="formUpdateTampilanKategori">
                    @csrf
                    <div class="modal-body">
                        <select name="kategori[]" class="form-control select2" id="kategori" multiple>
                            <option value="">Pilih Kategori Yang Ingin Ditampilkan</option>
                            @foreach ($categories as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-10">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mnTampilan').addClass('active');
            let dataBanner = @json($banner);

            $('#modalUpdateTampilanBanner').on('show.bs.modal', function(e) {
                $('#preview-banner').empty();
                $.each(dataBanner, function(index, value) {
                    $('#preview-banner').addClass(
                            'd-flex align-items-center').css('gap', '10px').css('width', '100%')
                        .css('flex-wrap', 'wrap')
                        .append(
                            $('<img/>').attr('src', value).addClass('img-fluid rounded-10')
                        )
                })
            });
            $('#modalUpdateTampilanKategori').on('show.bs.modal', function(e) {
                $('.select2').select2({
                    placeholder: 'Pilih Kategori Yang Akan Ditampilkan',
                    tags: true,
                    multiple: true,
                    dropdownParent: $('#modalUpdateTampilanKategori')
                });
            });

            $('#banner-tab3').on('show.bs.tab', function(e) {
                $('#btnUpdateTampilan').empty();
                $('#btnUpdateTampilan').append(
                    $('<button>').text('Edit Tampilan Banner').addClass(
                        'btn btn-primary rounded-10 btn-sm').attr('data-toggle', 'modal')
                    .attr('data-target', '#modalUpdateTampilanBanner')
                )
            });
            $('#kategori-tab3').on('show.bs.tab', function(e) {

                $('#btnUpdateTampilan').empty();
                $('#btnUpdateTampilan').append(
                    $('<button>').text('Edit Tampilan Kategori').addClass(
                        'btn btn-primary rounded-10 btn-sm').attr('data-toggle', 'modal')
                    .attr('data-target', '#modalUpdateTampilanKategori')
                )
            });

            $('#formUpdateTampilanKategori').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $.route('admin.tampilan.update', {
                        tampilan: 'kategori'
                    }),
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 201) {
                            Toast({
                                icon: 'success',
                                title: res.message
                            })
                        }
                    },
                    error: function(err) {
                        console.log(err);

                    }
                })
            })

            $('#formUpdateTampilanBanner').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $.route('admin.tampilan.update', {
                        tampilan: 'banner'
                    }),
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 201) {
                            Toast({
                                icon: 'success',
                                title: res.message
                            })
                        }
                    },
                    error: function(err) {
                        console.log(err);

                    }
                })
            })
        })
    </script>
@endpush
