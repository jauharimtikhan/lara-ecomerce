<div class="sidebar">
    <div class="sidebar-header">
        <div>
            <a href="{{ route('admin.dashboard.index') }}" class="sidebar-logo"><span>{{ config('app.name') }}</span></a>
            {{-- <small class="sidebar-logo-headline">Responsive Dashboard Template</small> --}}
        </div>
    </div><!-- sidebar-header -->
    <div id="dpSidebarBody" class="sidebar-body ">
        <ul class="nav nav-sidebar">
            <li class="nav-label"><label class="content-label">Menu Utama</label></li>
            @if (Auth::user()->roles->first()->name == 'super_admin')
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard.index') }}" id="mnDashboard" class="nav-link rounded-lg"><i
                            data-feather="home"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kategori.index') }}" id="mnKategori" class="nav-link  rounded-lg"><i
                            data-feather="layers"></i>
                        Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.subkategori.index') }}" id="mnSubkategori" class="nav-link rounded-lg"><i
                            data-feather="archive"></i>
                        Sub Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.produk.index') }}" id="mnProduk" class="nav-link rounded-lg"><i
                            data-feather="package"></i>
                        Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pesanan.index') }}" id="mnPesanan" class="nav-link rounded-lg"><i
                            data-feather="shopping-bag"></i>
                        Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" id="mnUser" class="nav-link  rounded-lg"><i
                            data-feather="users"></i>
                        Member
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.index') }}" id="mnLaporan" class="nav-link  rounded-lg">
                        <i data-feather="file-text"></i>
                        Laporan Penjualan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.tampilan.index') }}" id="mnTampilan" class="nav-link  rounded-lg">
                        <i data-feather="monitor"></i>
                        Tampilan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.hakakses.index') }}" id="mnHakAkses" class="nav-link  rounded-lg">
                        <i data-feather="shield"></i>
                        Hak Akses
                    </a>
                </li>
            @elseif(Auth::user()->roles->first()->name == 'admin')
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard.index') }}" id="mnDashboard" class="nav-link rounded-lg"><i
                            data-feather="home"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kategori.index') }}" id="mnKategori" class="nav-link  rounded-lg"><i
                            data-feather="layers"></i>
                        Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.subkategori.index') }}" id="mnSubkategori" class="nav-link rounded-lg"><i
                            data-feather="archive"></i>
                        Sub Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.produk.index') }}" id="mnProduk" class="nav-link rounded-lg"><i
                            data-feather="package"></i>
                        Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pesanan.index') }}" id="mnPesanan" class="nav-link rounded-lg"><i
                            data-feather="shopping-bag"></i>
                        Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" id="mnUser" class="nav-link  rounded-lg"><i
                            data-feather="users"></i>
                        Member
                    </a>
                </li>
            @endif
        </ul>

    </div><!-- sidebar-body -->
</div>
