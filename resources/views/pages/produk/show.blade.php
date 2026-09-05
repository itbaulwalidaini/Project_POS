@extends('layout.index')
@section('tabs', 'Produk')
@section('menu-opened', 'Detail Produk')
@section('menu', 'Master Data')
@section('submenu', 'Produk')
@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="card bg-white p-20 rounded-10 border border-white mb-4">
            <div class="row align-items-center">
                <!-- <div class="col-lg-5">
                    <div class="pe-60">
                        <div class="tab-content mb-10" id="myTabContent1">
                            <div aria-labelledby="details1-tab" class="tab-pane fade show active" id="details1-tab-pane" role="tabpanel" tabindex="0">
                                <img alt="product-details1" class="rounded-10" src="{{ asset('assets/images/product-details1.jpg') }}" />
                            </div>
                            <div aria-labelledby="details2-tab" class="tab-pane fade" id="details2-tab-pane" role="tabpanel" tabindex="0">
                                <img alt="product-details2" class="rounded-10" src="{{ asset('assets/images/product-details2.jpg') }}" />
                            </div>
                            <div aria-labelledby="details3-tab" class="tab-pane fade" id="details3-tab-pane" role="tabpanel" tabindex="0">
                                <img alt="product-details3" class="rounded-10" src="{{ asset('assets/images/product-details3.jpg') }}" />
                            </div>
                            <div aria-labelledby="details4-tab" class="tab-pane fade" id="details4-tab-pane" role="tabpanel" tabindex="0">
                                <img alt="product-details4" class="rounded-10" src="{{ asset('assets/images/product-details4.jpg') }}" />
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs border-0" id="myTab1" role="tablist" style="gap: 10px;">
                        <li class="nav-item" role="presentation">
                            <button aria-controls="details1-tab-pane" aria-selected="true" class="nav-link p-0 border-0 active" data-bs-target="#details1-tab-pane" data-bs-toggle="tab" id="details1-tab" role="tab" type="button">
                                <img alt="product-details1" class="rounded-10" src="{{ asset('assets/images/product-details1.jpg') }}" style="width: 100px; height: 100px;" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="details2-tab-pane" aria-selected="false" class="nav-link p-0 border-0" data-bs-target="#details2-tab-pane" data-bs-toggle="tab" id="details2-tab" role="tab" type="button">
                                <img alt="product-details2" class="rounded-10" src="{{ asset('assets/images/product-details2.jpg') }}" style="width: 100px; height: 100px;" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="details3-tab-pane" aria-selected="false" class="nav-link p-0 border-0" data-bs-target="#details3-tab-pane" data-bs-toggle="tab" id="details3-tab" role="tab" type="button">
                                <img alt="product-details3" class="rounded-10" src="{{ asset('assets/images/product-details3.jpg') }}" style="width: 100px; height: 100px;" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="details4-tab-pane" aria-selected="false" class="nav-link p-0 border-0" data-bs-target="#details4-tab-pane" data-bs-toggle="tab" id="details4-tab" role="tab" type="button">
                                <img alt="product-details4" class="rounded-10" src="{{ asset('assets/images/product-details4.jpg') }}" style="width: 100px; height: 100px;" />
                            </button>
                        </li>
                    </ul>
                </div> -->
                <div class="col-lg-7">
                    <div class="mt-3 mt-lg-0">
                        <nav>
                            <div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Deskripsi Produk</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                                <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false" disabled>Disabled</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                <div class="col-lg-8">
                                    <div class="default-table-area mx-minus-1 table-bordered">
                                        <div class="table-responsive">
                                            <table class="table align-middle">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-body fw-normal">Jenis Produk</td>
                                                        <td class="text-body fw-medium text-start">{{ str($produk->jenis)->title() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">Kode SKU</td>
                                                        <td class="text-body fw-medium text-start">{{ $produk->sku }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">Barcode</td>
                                                        <td class="text-body fw-medium text-start">{{ $produk->barcode ?? '(tidak tersedia)' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">Nama Produk</td>
                                                        <td class="text-body fw-medium text-start">{{ $produk->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">Tipe</td>
                                                        <td class="text-body fw-medium text-start">{{ $produk->tipe->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">Kategori</td>
                                                        <td class="text-body fw-medium text-start">{{ $produk->kategori->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">Satuan Dasar</td>
                                                        <td class="text-body fw-medium text-start">{{ $produk->satuan->nama }}/{{ $produk->satuan->kode }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">HPP / Harga Pokok</td>
                                                        <td class="text-body fw-medium text-start">Rp. {{ number_format($produk->hpp, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">Harga Jual Default</td>
                                                        <td class="text-body fw-medium text-start">Rp. {{ number_format($produk->hjretail, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-body fw-normal">Konversi Satuan</td>
                                                        <td class="text-body fw-medium text-start">1 </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-body fw-normal">Harga Jual Partai</td>
                                                        <td class="text-body fw-medium text-start">Rp. {{ number_format($produk->hjretail, 0, ',', '.') }}</td>
                                                    </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                <p> This is some placeholder content the <strong>Profile tab's</strong> associated content. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other .nav-powered navigation.</p>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                                <p>This is some placeholder content the <strong>Contact tab's</strong> associated content. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other .nav-powered navigation.</p>
                            </div>
                            <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
                                <p>This is some placeholder content the <strong>Disabled tab's</strong> associated content. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other .nav-powered navigation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection