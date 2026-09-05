<div>
    <div wire:ignore.self class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog modal-medium modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalTambah">Penyesuaian Stok</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="label fs-16 mb-2" for="jenis">Jenis Penyesuaian</label>
                                    <select wire:model.lazy="jenis_pny" wire:change="hitungSelisih" class="form-select form-control @error('jenis_pny') is-invalid @enderror" id="jenis">
                                        <option value="">Pilih</option>
                                        <option value="stok_masuk">Stok Masuk (Stock In)</option>
                                        <option value="stok_keluar">Stok Keluar (Stock Out)</option>
                                    </select>
                                    @error('jenis_pny')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @if(!empty($jenis_pny))
                            <hr>
                            <div>
                                <div class="form-group row mb-3">
                                    <label class="label label-khusus fs-16 mb-2 col-lg-3" for="notrans">No Transaksi</label>
                                    <div class="col-lg-9">
                                        <input type="text" wire:model="no_transaksi" class="form-control" id="notrans" readonly>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group row mb-3">
                                        <label class="label label-khusus fs-16 mb-2 col-lg-3" for="csku">SKU / Barcode</label>
                                        <div class="col-lg-9">
                                            <input type="text" wire:model.lazy="sku" wire:keydown.enter="setKode" wire:change="setKode" id="csku"
                                                class="form-control @error('sku') is-invalid @enderror" placeholder="Masukkan SKU / Barcode">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="label label-khusus fs-16 mb-2 col-lg-3" for="cnama">Nama</label>
                                        <div class="col-lg-9">
                                            <select wire:model.lazy="produk_id" wire:change="setData" class="form-select form-control @error('produk_id') is-invalid @enderror" id="cnama">
                                                <option value="">...</option>
                                                @foreach($produk as $dataProduk)
                                                <option value="{{ $dataProduk->id }}">{{ $dataProduk->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="label label-khusus fs-16 mb-2 col-lg-3">Satuan Dasar</label>
                                        <div class="col-lg-5">
                                            <input type="text" value="{{ !empty($satuan) ? $satuan : '' }}"
                                                class="form-control" @if(empty($produk_id)) disabled @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="label label-khusus fs-16 mb-2 col-lg-3">Stok Awal</label>
                                        <div class="col-lg-5">
                                            <input type="text" value="{{ $stok_awal !== null ? rtrim(rtrim(number_format($stok_awal, 3, '.', ''), '0'), '.') : '' }}"
                                                class="form-control" @if(empty($produk_id)) disabled @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="label label-khusus fs-16 mb-2 col-lg-3" for="stokfisik">Penyesuaian</label>
                                        <div class="col-lg-5">
                                            <input type="number" wire:model.lazy="jml_penyesuaian" wire:change="hitungSelisih" id="stokfisik"
                                                class="form-control @error('jml_penyesuaian') is-invalid @enderror"
                                                min="0.001" step="0.001" @if(empty($produk_id)) disabled @else placeholder="Jumlah Stok" @endif>
                                            @if($stokTidakCukup)
                                            <div class="invalid-feedback d-block">Melebihi stok awal</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="label label-khusus fs-16 mb-2 col-lg-3">Stok Akhir</label>
                                        <div class="col-lg-5">
                                            <input type="text" value="{{ $stokTidakCukup ? 'Melebihi stok awal' : ($stok_akhir !== null ? $stok_akhir : '') }}" class="form-control"
                                                @if(empty($produk_id)) disabled @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="label label-khusus fs-16 mb-2 col-lg-3">Total HPP</label>
                                        <div class="col-lg-5">
                                            <input type="text" value="{{ $stokTidakCukup ? 'Melebihi stok awal' : ($total_hpp === null ? '' : ($total_hpp > 0 ? '+' . $total_hpp : $total_hpp)) }}" class="form-control"
                                                @if(empty($produk_id)) disabled @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="label label-khusus fs-16 mb-2 col-lg-3">Keterangan</label>
                                        <div class="col-lg-9">
                                            @if(empty($produk_id))
                                            <input type="text" class="form-control" disabled>
                                            @else
                                            <select wire:model.lazy="ket_stok_id" class="form-select form-control @error('ket_stok_id') is-invalid @enderror" @if(empty($produk_id)) disabled @endif>
                                                <option value="">...</option>
                                                @foreach($ketStok as $dataAlasan)
                                                <option value="{{ $dataAlasan->id }}">{{ $dataAlasan->caption }}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            @error('ket_stok_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="validasiSimpan" type="button" class="btn btn-primary fw-normal text-white w-100 py-3" wire:loading.attr="disabled" wire:target="validasiSimpan">
                        <span wire:loading.remove wire:target="validasiSimpan">Simpan</span>
                        <span wire:loading wire:target="validasiSimpan"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Menyimpan...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    const modalTambah = document.getElementById('tambahData');

    modalTambah.addEventListener('show.bs.modal', () => {
        $wire.dispatch('bukaModalTambah');
    });

    $wire.on('tutupModalTambah', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('tambahData')).hide();
    });

    modalTambah.addEventListener('hidden.bs.modal', () => {
        $wire.dispatch('resetModal');
    });
</script>
@endscript