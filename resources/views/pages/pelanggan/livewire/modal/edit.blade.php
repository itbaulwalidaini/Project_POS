<div>
    <div wire:ignore.self class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
        <div class="modal-dialog modal-medium modal-dialog-centered">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalEdit">Edit Data : {{ $title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="col-lg-12">
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="eid">ID Pelanggan</label>
                                <div class="col-lg-9">
                                    <input type="text" wire:model="idPelanggan" class="form-control" id="eid" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="enama">Nama</label>
                                <div class="col-lg-9">
                                    <input type="text" wire:model.lazy="nama" class="form-control @error('nama') is-invalid @enderror" id="enama">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="egender">Jenis Kelamin</label>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <select wire:model.lazy="gender" class="form-select form-control @error('gender') is-invalid @enderror" id="egender">
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
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="enohp">No Telepon</label>
                                <div class="col-lg-9">
                                    <input type="number" wire:model.lazy="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="enohp" min="1">
                                    @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="ealamat">Alamat</label>
                                <div class="col-lg-9">
                                    <textarea wire:model.lazy="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat lengkap" id="ealamat" style="height: 85px"></textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label class="label label-khusus fs-16 mb-2 col-lg-3" for="estatus">Status</label>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <select wire:model.lazy="is_active" class="form-select form-control" id="estatus">
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
                    <button wire:click="update" type="button" class="btn btn-success fw-normal text-white w-100 py-3" wire:loading.attr="disabled" wire:target="update">
                        <span wire:loading.remove wire:target="update">Update</span>
                        <span wire:loading wire:target="update"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Mengupdate...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    const modalEdit = document.getElementById('editData');

    $wire.on('bukaModalEdit', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('editData')).show();
    });

    $wire.on('tutupModalEdit', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('editData')).hide();
    });

    modalEdit.addEventListener('hidden.bs.modal', () => {
        $wire.dispatch('resetModal');
    });
</script>
@endscript