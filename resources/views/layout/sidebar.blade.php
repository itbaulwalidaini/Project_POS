<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative d-flex align-items-center justify-content-between">
        <a class="d-block text-decoration-none position-relative" href="#">
            <img alt="logo-icon" src="{{ asset('assets/images/logo-icon.png') }}" />
            <span class="logo-text text-secondary fw-semibold">
                MiniPOS
            </span>
        </a>
        <button
            class="sidebar-burger-menu-close bg-transparent py-3 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu-close">
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(45deg);">
            </span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(-45deg);">
            </span>
        </button>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0" id="sidebar-burger-menu">
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px;">
            </span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;">
            </span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px;">
            </span>
        </button>
    </div>
    <aside class="layout-menu menu-vertical menu active" data-simplebar="" id="layout-menu">
        <ul class="menu-inner">
            <li class="menu-title small text-uppercase"><span class="menu-title-text">Menu Utama</span></li>
            <li class="menu-item">
                <a class="menu-link" href="#">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li
                class="menu-item {{ request()->is('produk*') || request()->is('pelanggan*') || request()->is('vendor*') ? 'open' : '' }}">
                <a class="menu-link menu-toggle {{ request()->is('produk*') || request()->is('pelanggan*') || request()->is('vendor*') ? 'active' : '' }}"
                    href="javascript:void(0);"><span class="material-symbols-outlined menu-icon">inventory_2</span>
                    <span class="title">Master Data</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item"><a class="menu-link {{ request()->is('produk*') ? 'active' : '' }}"
                            href="{{ route('produk.index') }}">Produk</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->is('pelanggan*') ? 'active' : '' }}"
                            href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                    <!-- <li class="menu-item"><a class="menu-link {{ request()->is('vendor*') ? 'active' : '' }}" href="">Vendor</a></li> -->
                </ul>
            </li>
            <li
                class="menu-item {{ request()->is('perencanaan*') || request()->is('realisasi-pembelian*') ? 'open' : '' }}">
                <a class="menu-link menu-toggle {{ request()->is('perencanaan*') || request()->is('realisasi-pembelian*') ? 'active' : '' }}"
                    href="javascript:void(0);"><span
                        class="material-symbols-outlined menu-icon">add_shopping_cart</span>
                    <span class="title">Pembelian</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item"><a class="menu-link {{ request()->is('perencanaan*') ? 'active' : '' }}"
                            href="{{ route('perencanaan.index') }}">Perencanaan</a></li>
                    <li class="menu-item"><a
                            class="menu-link {{ request()->is('realisasi-pembelian*') ? 'active' : '' }}"
                            href="{{ route('realisasi-pembelian.index') }}">Realisasi Pembelian</a></li>
                </ul>
            </li>
            <li
                class="menu-item {{ request()->is('stok-awal*') || request()->is('stok-opname*') || request()->is('riwayat-stok*') || request()->is('penyesuaian-stok*') ? 'open' : '' }}">
                <a class="menu-link menu-toggle {{ request()->is('stok-awal*') || request()->is('stok-opname*') || request()->is('riwayat-stok*') || request()->is('penyesuaian-stok*') ? 'active' : '' }}"
                    href="javascript:void(0);"><span class="material-symbols-outlined menu-icon">inventory</span>
                    <span class="title">Manajemen Stok</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item"><a class="menu-link {{ request()->is('stok-awal*') ? 'active' : '' }}"
                            href="{{ route('stok-awal.index') }}">Stok Awal</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->is('stok-opname*') ? 'active' : '' }}"
                            href="{{ route('stok-opname.index') }}">Stok Opname</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->is('penyesuaian-stok*') ? 'active' : '' }}"
                            href="{{ route('penyesuaian-stok.index') }}">Penyesuaian Stok</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->is('riwayat-stok*') ? 'active' : '' }}"
                            href="#">Riwayat Stok</a></li>
                </ul>
            </li>









            <li
                class="menu-item {{ request()->is('kategori*') || request()->is('satuan*') || request()->is('kelompok-satuan*') || request()->is('keterangan-stok*') ? 'open' : '' }}">
                <a class="menu-link menu-toggle {{ request()->is('kategori*') || request()->is('satuan*') || request()->is('kelompok-satuan*') || request()->is('keterangan-stok*') ? 'active' : '' }}"
                    href="javascript:void(0);"><span class="material-symbols-outlined menu-icon">prescriptions</span>
                    <span class="title">Referensi</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item"><a class="menu-link {{ request()->is('kategori*') ? 'active' : '' }}"
                            href="{{ route('kategori.index') }}">Kategori</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->is('satuan*') ? 'active' : '' }}"
                            href="{{ route('satuan.index') }}">Satuan</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->is('kelompok-satuan*') ? 'active' : '' }}"
                            href="{{ route('kelompok-satuan.index') }}">Kelompok Satuan</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->is('keterangan-stok*') ? 'active' : '' }}"
                            href="{{ route('keterangan-stok.index') }}">Keterangan Stok</a></li>
                </ul>
            </li>
            <li class="menu-item"><a class="menu-link" href="#"><span
                        class="material-symbols-outlined menu-icon">logout</span><span class="title">Logout</span></a>
            </li>
        </ul>
    </aside>
</div>
