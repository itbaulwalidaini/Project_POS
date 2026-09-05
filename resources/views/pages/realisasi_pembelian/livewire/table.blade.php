<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17">

        <!-- select bar -->
        <div class="table-select-form d-flex justify-content-start align-items-center gap-3">
            <select class="form-select form-control custom" wire:model.lazy="perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        <!-- search bar -->
        <div class="table-src-form position-relative m-0">
            <input class="form-control custom" placeholder="Cari apa ?" type="text" wire:model.live.debounce.300ms="search" />
            <div class="src-btn position-absolute top-50 start-0 translate-middle-y bg-transparent p-0 border-0">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>
    <div class="default-table-area mx-minus-1">

        <!-- table area -->
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="fw-medium" scope="col">No.</th>
                        <th class="fw-medium" scope="col">Kode Transaksi</th>
                        <th class="fw-medium" scope="col">Mode Realisasi</th>
                        <th class="fw-medium" scope="col">Keterangan</th>
                        <th class="fw-medium" scope="col">Total Belanja</th>
                        <th class="fw-medium" scope="col">Tanggal Input</th>
                        <th class="fw-medium" scope="col">Diinput Oleh</th>
                        <th class="fw-medium text-start" scope="col">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($realisasiPemb as $baris)
                    <tr>
                        <td class="text-body">{{ str_pad($realisasiPemb->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT) }}.</td>
                        <td class="text-body fw-bold">{{ $baris->kode }}</td>
                        <td class="text-body">
                            @if($baris->perencanaan_id != null)
                            <span class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge style-two border border-success">
                                Perencanaan
                            </span>
                            @else
                            <span class="text-primary bg-primary bg-opacity-10 fs-15 fw-normal d-inline-block default-badge style-two border border-primary">
                                Input Manual
                            </span>
                            @endif
                        </td>
                        <td class="text-body">{{ $baris->keterangan }}</td>
                        <td class="text-body">{{ number_format($baris->total_belanja, 0, ',', '.') }}</td>
                        <td class="text-body">{{ $baris->created_at->translatedFormat('l, d F Y') }}</td>
                        <td class="text-start">
                            <span class="text-primary bg-primary bg-opacity-10 fs-15 fw-normal d-inline-block default-badge style-two border border-primary">
                                x
                            </span>
                        </td>
                        <td>
                            <div class="menu d-flex justify-content-start" style="gap: 12px;">
                                <button type="button" wire:click="show({{ $baris->id }})" class="btn btn-info fs-15 p-2 border-0 text-white hover-white">
                                    <i class="ri-eye-line"></i> Detail
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="text-center">
                                @if ($search)
                                <h4 class="custom-h4">Maaf, Data Tidak Ditemukan</h4>
                                <p class="text-muted mb-0">Tidak ada hasil untuk pencarian '<b>{{ $search }}</b>'.</p>
                                @else
                                <h4 class="custom-h4">Data Masih Kosong !</h4>
                                <p class="text-muted mb-0">Belum ada data yang tersedia.</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- footer area -->
        <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap pt-15 p-17">
            {{ $realisasiPemb->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>