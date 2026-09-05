<div>
    <div wire:ignore.self class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog modal-medium modal-dialog-centered">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalTambah">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="col-lg-12">
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="cid">ID Pelanggan</label>
                                <div class="col-lg-9">
                                    <input type="text" wire:model="idPelanggan" class="form-control" id="cid" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="cnama">Nama</label>
                                <div class="col-lg-9">
                                    <input type="text" wire:model.lazy="nama" class="form-control @error('nama') is-invalid @enderror" id="cnama">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="cgender">Jenis Kelamin</label>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <select wire:model.lazy="gender" class="form-select form-control @error('gender') is-invalid @enderror" id="cgender">
                                            <option value="">-</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="cnohp">No Telepon</label>
                                <div class="col-lg-9">
                                    <input type="number" wire:model.lazy="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="cnohp" min="1">
                                    @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="calamat">Alamat</label>
                                <div class="col-lg-9">
                                    <textarea wire:model.lazy="alamat" class="form-control @error('alamat') is-invalid @enderror" id="calamat" placeholder="Alamat lengkap" style="height: 85px"></textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="cstatus">Status</label>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <select wire:model.lazy="is_active" class="form-select form-control" id="cstatus">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="store" type="button" class="btn btn-primary fw-normal text-white w-100 py-3" wire:loading.attr="disabled" wire:target="store">
                        <span wire:loading.remove wire:target="store">Simpan</span>
                        <span wire:loading wire:target="store"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Menyimpan...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    const modalTambah = document.getElementById('tambahData');

    $wire.on('tutupModalTambah', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('tambahData')).hide();
    });

    modalTambah.addEventListener('hidden.bs.modal', () => {
        $wire.dispatch('resetModal');
    });
</script>
@endscript