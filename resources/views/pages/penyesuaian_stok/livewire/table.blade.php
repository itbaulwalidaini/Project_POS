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
                        <th class="fw-medium" scope="col">No Transaksi</th>
                        <th class="fw-medium" scope="col">Nama Produk</th>
                        <th class="fw-medium" scope="col">Jenis Penyesuaian</th>
                        <th class="fw-medium" scope="col">Jumlah</th>
                        <th class="fw-medium text-start" scope="col">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataPenyesuaian as $baris)
                    <tr>
                        <td class="text-body">{{ str_pad($dataPenyesuaian->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT) }}.</td>
                        <td class="text-body">{{ $baris->no_transaksi }}</td>
                        <td class="text-body">{{ $baris->produk->nama }}</td>
                        <td class="text-body">{{ str(str_replace('_', ' ', $baris->jenis))->title() }}</td>
                        <td class="text-body">{{ (float) $baris->stok_pny }}</td>
                        <td>
                            <div class="menu d-flex justify-content-start" style="gap: 12px;">
                                <button wire:click="show({{ $baris->id }})" class="bg-transparent p-0 border-0 hover-text-success" data-bs-placement="top" data-bs-title="Lihat Data" data-bs-toggle="tooltip">
                                    <i class="material-symbols-outlined fs-25 fw-normal text-body">visibility</i>
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
            {{ $dataPenyesuaian->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>