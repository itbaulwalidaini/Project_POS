@extends('layout.index')
@section('tabs', 'Detail Pelanggan')
@section('menu-opened', 'Detail Pelanggan')
@section('menu', 'Master Data')
@section('submenu', 'Pelanggan')
@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="main-content-container overflow-hidden">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card bg-white rounded-10 border border-white p-17-custom mb-4">
                        <div class="text-center mb-20">
                            <img alt="admin" class="rounded-circle mb-12" src="{{ asset('assets/images/admin.png') }}" style="width: 160px; height: 160px;" />
                            <h3 class="fs-22 mb-1 pt-1">{{ $pelanggan->nama }}</h3>
                            <span class="mt-1 text-primary bg-primary bg-opacity-10 fs-15 fw-normal d-inline-block default-badge style-two border border-primary">
                                {{ $pelanggan->level }}
                            </span>
                        </div>
                        <h3 class="border-border-color-50 mb-3" style="border-bottom: 2px dashed;"></h3>
                        <ul class="ps-0 mb-3 list-unstyled last-child-none">
                            <li class="mb-3">
                                <span class="fs-16 d-block text-secondary fw-medium mb-1">ID Pelanggan :</span>
                                <span class="fs-16 d-block">{{ $pelanggan->id_pelanggan }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fs-16 d-block text-secondary fw-medium mb-1">Jenis Kelamin :</span>
                                <span class="fs-16 d-block">
                                    @if($pelanggan->jenis_kelamin == 'L')
                                    Laki-laki
                                    @elseif($pelanggan->jenis_kelamin == 'P')
                                    Perempuan
                                    @else
                                    -
                                    @endif
                                </span>
                            </li>
                            <li class="mb-3">
                                <span class="fs-16 d-block text-secondary fw-medium mb-1">WhatsApp :</span>
                                <span class="fs-16 d-block">{{ $pelanggan->no_hp }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fs-16 d-block text-secondary fw-medium mb-1">Alamat Lengkap :</span>
                                <span class="fs-16 d-block">{{ $pelanggan->alamat }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fs-16 d-block text-secondary fw-medium mb-1">Status Member :</span>
                                @if($pelanggan->is_active == 1)
                                <span class="mt-1 text-success bg-success text-white fs-16 fw-normal d-inline-block default-badge style-two border border-success">
                                    Aktif
                                </span>
                                @elseif($pelanggan->is_active == 0)
                                <span class="mt-1 text-danger bg-danger text-white fs-15 fw-normal d-inline-block default-badge style-two border border-danger">
                                    Nonaktif
                                </span>
                                @else
                                -
                                @endif
                            </li>
                            <li class="mb-3">
                                <span class="fs-16 d-block text-secondary fw-medium mb-1">Transaksi Terakhir :</span>
                                <span class="fs-16 d-block">{{ $pelanggan->updated_at->translatedFormat('d F Y, H:i:s') }} WIB</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-white p-20 py-30 rounded-10 border border-white mb-4 position-relative z-1">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-10 lh-1 fs-14 text-body">Total Poin Terkumpul</h3>
                                        <h2 class="fs-26 fw-bold mb-10 lh-1">100</h2>
                                    </div>
                                    <div class="flex-shrink-0 ms-3 position-relative" style="width: 64px;">
                                        <div class="w-100 position-absolute top-50 translate-middle-y">
                                            <img alt="calendar-3d" src="{{ asset('assets/images/calendar-3d.png') }}" />
                                            <span class="position-absolute bottom-0 start-0 rounded-circle z-n1 d-inline-block" style="background-color: #EFF3F9; width: 54px; height: 54px; bottom: -19px !important; left: -19px !important;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card bg-white p-20 py-30 rounded-10 border border-white mb-4 position-relative z-1">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-10 lh-1 fs-14 text-body">
                                            Total Patient
                                        </h3>
                                        <h2 class="fs-26 fw-bold mb-10 lh-1">
                                            1024K
                                        </h2>
                                        <div class="d-inline-block" style="margin-bottom: 1px;">
                                            <span class="d-flex align-content-center gap-1 bg-danger border-white rounded-1" style="padding: 3px 5px;">
                                                <i class="material-symbols-outlined fs-14 text-white">
                                                    trending_down
                                                </i>
                                                <span class="lh-1 fs-14 text-white">
                                                    1.25%
                                                </span>
                                            </span>
                                        </div>
                                        <p class="mb-0 fs-14">
                                            Increases this week
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 ms-3 position-relative" style="width: 64px;">
                                        <div class="w-100 position-absolute top-50 translate-middle-y">
                                            <img alt="patient" src="assets/images/patient.png" />
                                            <span class="position-absolute bottom-0 start-0 rounded-circle z-n1 d-inline-block" style="background-color: #EFF3F9; width: 54px; height: 54px; bottom: -19px !important; left: -19px !important;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card bg-white p-20 py-30 rounded-10 border border-white mb-4 position-relative z-1">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-10 lh-1 fs-14 text-body">
                                            Doctors
                                        </h3>
                                        <h2 class="fs-26 fw-bold mb-10 lh-1">
                                            64
                                        </h2>
                                        <div class="d-inline-block" style="margin-bottom: 1px;">
                                            <span class="d-flex align-content-center gap-1 bg-danger border-white rounded-1" style="padding: 3px 5px;">
                                                <i class="material-symbols-outlined fs-14 text-white">
                                                    trending_down
                                                </i>
                                                <span class="lh-1 fs-14 text-white">
                                                    0.31%
                                                </span>
                                            </span>
                                        </div>
                                        <p class="mb-0 fs-14">
                                            Increases this week
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 ms-3 position-relative" style="width: 64px;">
                                        <div class="w-100 position-absolute top-50 translate-middle-y">
                                            <img alt="consultation" src="assets/images/consultation.png" />
                                            <span class="position-absolute bottom-0 start-0 rounded-circle z-n1 d-inline-block" style="background-color: #EFF3F9; width: 54px; height: 54px; bottom: -19px !important; left: -19px !important;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card bg-white p-20 py-30 rounded-10 border border-white mb-4 position-relative z-1">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-10 lh-1 fs-14 text-body">
                                            Earnings
                                        </h3>
                                        <h2 class="fs-26 fw-bold mb-10 lh-1">
                                            $124K
                                        </h2>
                                        <div class="d-inline-block" style="margin-bottom: 1px;">
                                            <span class="d-flex align-content-center gap-1 bg-success-70 border-white rounded-1" style="padding: 3px 5px;">
                                                <i class="material-symbols-outlined fs-14 text-white">
                                                    trending_up
                                                </i>
                                                <span class="lh-1 fs-14 text-white">
                                                    3.11%
                                                </span>
                                            </span>
                                        </div>
                                        <p class="mb-0 fs-14">
                                            Increases this week
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 ms-3 position-relative" style="width: 64px;">
                                        <div class="w-100 position-absolute top-50 translate-middle-y">
                                            <img alt="burn" src="assets/images/burn.png" />
                                            <span class="position-absolute bottom-0 start-0 rounded-circle z-n1 d-inline-block" style="background-color: #EFF3F9; width: 54px; height: 54px; bottom: -19px !important; left: -19px !important;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-white rounded-10 border border-white p-13-custom mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-body-bg p-20 rounded-10 border border-white mb-3">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h3 class="mb-10">Jumlah Poin</h3>
                                            <h2 class="fs-26 fw-medium mb-0 lh-1">100</h2>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <div class="bg-warning text-white text-center rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px;">
                                                <i class="material-symbols-outlined fs-30">card_giftcard</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center" style="margin-top: 23px;">
                                        <p class="mb-0 fs-15">Berlaku hingga :</p>
                                        <span class="d-flex align-content-center gap-1 bg-danger bg-opacity-10 border border-danger" style="padding: 3px 5px;">
                                            <span class="lh-1 fs-14 text-danger">31 Desember 2026</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-body-bg p-20 rounded-10 border border-white mb-3">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h3 class="mb-10">Total Poin Terkumpul</h3>
                                            <h2 class="fs-26 fw-medium mb-0 lh-1">100</h2>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <div class="bg-primary text-white text-center rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px;">
                                                <i class="material-symbols-outlined fs-30">account_balance_wallet</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center" style="margin-top: 23px;">
                                        <p class="mb-0 fs-15">Berlaku hingga :</p>
                                        <span class="d-flex align-content-center gap-1 bg-success bg-opacity-10 border border-success" style="padding: 3px 5px;">
                                            <span class="lh-1 fs-14 text-success">31 Desember 2026</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>






                <div class="col-lg-9">
                    <div class="card bg-white rounded-10 border border-white mb-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
                            <h3>
                                Transactions History
                            </h3>
                            <div class="dropdown select-dropdown without-border">
                                <button aria-expanded="false" class="dropdown-toggle bg-transparent text-secondary fs-15" data-bs-toggle="dropdown">
                                    Last Month
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end bg-white border-0 box-shadow rounded-10" data-simplebar="">
                                    <li>
                                        <button class="dropdown-item text-secondary">
                                            Last Day
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item text-secondary">
                                            Last Week
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item text-secondary">
                                            Last Month
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item text-secondary">
                                            Last Year
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="default-table-area mx-minus-1 table-to-do-list">
                            <div class="table-responsive">
                                <table class="table align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th class="fw-medium pe-0 rtl-pe" scope="col">
                                                Order ID
                                            </th>
                                            <th class="fw-medium" scope="col">
                                                Status
                                            </th>
                                            <th class="fw-medium" scope="col">
                                                Amount
                                            </th>
                                            <th class="fw-medium" scope="col">
                                                Rewards
                                            </th>
                                            <th class="fw-medium text-start" scope="col">
                                                Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-body pe-0 rtl-pe">
                                                #ARP-1217
                                            </td>
                                            <td>
                                                <span class="text-primary bg-primary bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                                    Successful
                                                </span>
                                            </td>
                                            <td class="text-body">
                                                $6855.00
                                            </td>
                                            <td class="text-body">
                                                $12.00
                                            </td>
                                            <td class="text-body text-start">
                                                14 Jan 2025
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-body pe-0 rtl-pe">
                                                #ARP-1231
                                            </td>
                                            <td>
                                                <span class="text-primary bg-primary bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                                    Successful
                                                </span>
                                            </td>
                                            <td class="text-body">
                                                $258.00
                                            </td>
                                            <td class="text-body">
                                                $9.00
                                            </td>
                                            <td class="text-body text-start">
                                                13 Jan 2025
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-body pe-0 rtl-pe">
                                                #ARP-4123
                                            </td>
                                            <td>
                                                <span class="text-warning bg-warning bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                                    Pending
                                                </span>
                                            </td>
                                            <td class="text-body">
                                                $3,890.00
                                            </td>
                                            <td class="text-body">
                                                $11.00
                                            </td>
                                            <td class="text-body text-start">
                                                12 Jan 2025
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-body pe-0 rtl-pe">
                                                #ARP-4212
                                            </td>
                                            <td>
                                                <span class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                                    Rejected
                                                </span>
                                            </td>
                                            <td class="text-body">
                                                $2,500.00
                                            </td>
                                            <td class="text-body">
                                                $23.42
                                            </td>
                                            <td class="text-body text-start">
                                                11 Jan 2025
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-body pe-0 rtl-pe">
                                                #ARP-1234
                                            </td>
                                            <td>
                                                <span class="text-primary bg-primary bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                                    Successful
                                                </span>
                                            </td>
                                            <td class="text-body">
                                                $8,200.00
                                            </td>
                                            <td class="text-body">
                                                $10.84
                                            </td>
                                            <td class="text-body text-start">
                                                10 Jan 2025
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>



@endsection