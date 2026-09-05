<div>
    <div wire:ignore.self class="modal fade" id="lihatData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahData" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalLihat">{{ $nama }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="col-lg-12">
                        <div class="default-table-area mx-minus-1 mb-3">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <tbody>
                                        <tr>
                                            <td class="text-body fw-normal">No Transaksi</td>
                                            <td class="text-body fw-medium text-start">{{ $notrans }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-body fw-normal">Tipe Produk</td>
                                            <td class="text-body fw-medium text-start">{{ $tipe }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-body fw-normal">Jenis Penyesuaian</td>
                                            <td class="text-body fw-medium text-start">{{ str(str_replace('_', ' ', $jnspny))->title() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-body fw-normal">Stok Awal</td>
                                            <td class="text-body fw-medium text-start">{{ (float) $stk_awal }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-body fw-normal">Jumlah Penyesuaian</td>
                                            <td class="text-body fw-medium text-start">{{ (float) $stk_pny}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-body fw-normal">Stok Akhir</td>
                                            <td class="text-body fw-medium text-start">{{ (float) $stk_akhir }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-body fw-normal">Total HPP</td>
                                            <td class="text-body fw-medium text-start">{{ number_format($ttl_hpp, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-body fw-normal">Keterangan</td>
                                            <td class="text-body fw-medium text-start">{{ $alasan }}</td>
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

@script
<script>
    const modalLihat = document.getElementById('lihatData');

    $wire.on('bukaModalLihat', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('lihatData')).show();
    });
</script>
@endscript