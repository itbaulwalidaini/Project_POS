<div>
    <div wire:ignore.self class="modal fade" id="lihatData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahData" aria-hidden="true">
        <div class="modal-dialog modal-xxl modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalLihat">Laporan Stok Opname Per-tanggal : {{ $d_title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="main-content-container overflow-hidden">
                            <!-- Header Toko -->
                            <div class="text-center">
                                <h3 class="mb-1 fw-bold">TOKO EVANOS 2 KAMULAN</h3>
                                <div class="fs-15">Jl. Raya Sendang Kamulyan, Durenan, Trenggalek. Telp. 083845724228</div>
                            </div>
                            <hr class="mb-2">

                            <!-- Informasi -->
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="fw-normal mb-2 fs-16"><span class="text-body">Batch : </span><b>{{ $d_batch }}</b></h5>
                                    <h5 class="fw-normal mb-2 fs-16"><span class="text-body">Tanggal Input : </span><b>{{ $d_tanggal_input }}</b></h5>
                                    <p class="mb-0 fs-15">Catatan : {{ $d_keterangan }}</p>
                                </div>
                                <div class="text-center">
                                    <h5 class="fw-normal mb-2 fs-16"><span class="text-body">Status </span>
                                        <span class="text-success bg-success bg-opacity-10 fs-16 fw-normal d-inline-block default-badge style-two">Approved</span>
                                    </h5>

                                </div>
                            </div>
                        </div>
                        <div class="default-table-area">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr class="border-start-0 border-end-0 border-border-color" style="border: 1px dashed;">
                                            <th class="fw-medium" scope="col">No.</th>
                                            <th class="fw-medium" scope="col">Nama</th>
                                            <th class="fw-medium" scope="col">Tipe</th>
                                            <th class="fw-medium" scope="col">Stok Sistem</th>
                                            <th class="fw-medium" scope="col">Stok Fisik</th>
                                            <th class="fw-medium" scope="col">Satuan</th>
                                            <th class="fw-medium" scope="col">Selisih Stok</th>
                                            <th class="fw-medium" scope="col">Selisih HPP</th>
                                            <th class="fw-medium text-start" scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailStokOpname as $detail)
                                        <tr>
                                            <td class="text-body">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.</td>
                                            <td class="text-body">{{ $detail['nama_produk'] }}</td>
                                            <td class="text-body">{{ $detail['tipe'] }}</td>
                                            <td class="text-body">{{ (float) $detail['stok_sistem'] }}</td>
                                            <td class="text-body">{{ (float) $detail['stok_fisik'] }}</td>
                                            <td class="text-body">{{ $detail['satuan'] }}</td>
                                            <td class="text-body">{{ (float) $detail['selisih_stok'] }}</td>
                                            <td class="text-body">{{ number_format($detail['selisih_hpp'], 0, ',', '.') }}</td>
                                            <td class="text-body text-start">{{ $detail['ket'] ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-body fw-bold fs-20" colspan="6">Total Selisih Stok / HPP:</td>
                                            <td class="text-body fw-bold fs-20">{{ number_format($total2, 0, ',', '.') }}</td>
                                            <td class="text-body fw-bold fs-20">{{ number_format($total, 0, ',', '.') }}</td>
                                            <td colspan="1"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 justify-content-center mt-3 mb-0">
                            <button class="btn btn-primary text-white">
                                Print
                            </button>
                            <button class="btn btn-info text-white">
                                Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    const modalLihat = document.getElementById('lihatData');

    $wire.on('bukaModalLihat', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('lihatData')).show();
    });
</script>
@endscript